<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-3 text-center">
        <form id="board-save-message" class="form-horizontal" @submit.prevent="submitForm">
          <div class="form-group row">
            <label class="col-md-2 col-form-label font-weight-bold" for="theme">Тема</label>
            <div class="col-md-5">
              <input type="text"
                     v-model.trim="theme"
                     :class="{'is-invalid': ($v.theme.$dirty && !$v.theme.maxLength)}"
                     id="theme" class="form-control" name="theme" placeholder="Напишите тему сообщения"
                     aria-describedby="themeHelp" maxlength="64">
              <small id="themeHelp" class="form-text text-warning" v-if="$v.theme.$dirty && !$v.theme.maxLength">
                Максимальная длина "темы" {{ $v.theme.$params.maxLength.max }} символ
              </small>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2 col-form-label font-weight-bold" for="user_name">Имя</label>
            <div class="col-md-5">
              <input type="text" id="user_name" class="form-control" name="user_name"
                     v-model.trim="user_name"
                     :class="{'is-invalid': ($v.user_name.$dirty && !$v.user_name.maxLength)}"
                     placeholder="Представьтесь" aria-required="true" aria-describedby="user_nameHelp" maxlength="64">
              <small id="user_nameHelp" class="form-text text-warning"
                     v-if="$v.user_name.$dirty && !$v.user_name.maxLength">
                Максимальная длина "темы" {{ $v.user_name.$params.maxLength.max }} символ
              </small>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2 col-form-label font-weight-bold" for="text">Сообщение</label>
            <div class="col-md-5">
              <textarea id="text" class="form-control" name="text" rows="6" aria-required="true"
                        aria-describedby="textHelp"
                        v-model.trim="text"
                        :class="{'is-invalid': ($v.text.$dirty && !$v.text.required) || ($v.text.$dirty && !$v.text.minLength) || ($v.text.$dirty && !$v.text.maxLength)}"></textarea>
              <small id="textHelp" class="form-text text-warning"
                     v-if="($v.text.$dirty && !$v.text.required) || ($v.text.$dirty && !$v.text.minLength)|| ($v.text.$dirty && !$v.text.maxLength)">
                Сообщение должно быть не менее {{ $v.text.$params.minLength.min }} или больше {{ $v.text.$params.maxLength.max }} символов.
              </small>
            </div>

          </div>
          <div class="form-group row">
            <div class="col-md-5 offset-md-2">
              <button type="submit" class="btn btn-primary btn-md btn-block">Отправить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</template>

<script>
import messageService from "./service/message.service";
import {minLength, maxLength, required} from 'vuelidate/lib/validators';

export default {
  name: "AddMessage",
  validations: {
    user_name: {maxLength: maxLength(64)},
    theme: {maxLength: maxLength(64)},
    text: {required, minLength: minLength(3), maxLength: maxLength(1000)}
  },
  data() {
    return {
      user_name: '',
      theme: '',
      text: ''
    }
  },
  methods: {
    async submitForm($event) {
      /**
       * Проверяем валидацию полей
       */
      if (this.$v.$invalid) {
        this.$v.$touch();
        return;
      }
      /**
       * Пробуем сохранить сообщение
       */
      try {
        const {status, data} = await messageService.create(this.theme, this.user_name, this.text);
        if (status === 200 && data.message === 'success') {
          $event.target.reset();
        }
      } catch (e) {
        console.log(e.response);
      }
    }
  }
}
</script>