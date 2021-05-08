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
                     aria-describedby="themeHelp">
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
                     placeholder="Представьтесь" aria-required="true" aria-describedby="user_nameHelp">
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
                        :class="{'is-invalid': ($v.text.$dirty && !$v.text.required) || ($v.text.$dirty && !$v.text.minLength)}"></textarea>
              <small id="textHelp" class="form-text text-warning"
                     v-if="($v.text.$dirty && !$v.text.required) || ($v.text.$dirty && !$v.text.minLength)">
                Сообщение должно быть не менее {{ $v.text.$params.minLength.min }} символов.
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
    user_name: {maxLength: maxLength(255)},
    theme: {maxLength: maxLength(128)},
    text: {required, minLength: minLength(3)}
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
      if (this.$v.$invalid) {
        this.$v.$touch();
        return;
      }

      try {
        const {status, data} = await messageService.create(this.theme, this.user_name, this.text);
        if (status === 200 && data.message === 'success') {
          $event.target.reset();
        }
      } catch (e) {
        console.log(e.response);
      }
    },
    async saveMessage($event) {
      let theme = $event.target.elements.theme.value;
      let user_name = $event.target.elements.user_name.value;
      let text = $event.target.elements.text.value;
      try {
        const {status, data} = await messageService.create(theme, user_name, text);
        console.log(data);
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