const token = 's5HW4YD8FYWN8w9UWOn6Po50U3Y7d1ca7WdwxseXaU46WeAXKvGhwyyzHdsZmS2Cs9ahNvkq8HwI5aEYDjCiKxhAdPkBdDXJh3Q3wL1A5rQEdhF3aOBO9InP1VwOrb7c8BcgJUdUBRhkjAH6TS5Bwd6UjXkirxT93kQG0JSVIDiewDZVzbWiigkaQMYmuojlG7WTjUzBLvvVatI2rUD98ucqJyidETBK7Tzcw4cv7X15Y96Sc1iDHPP5avmaJIdRvFAsK9LaNbHkkQqM15rPjYNVjh4qnICHlrujtWXfBXFjvejeJaVYcR9bd4MuUKNXI2otwVDnxRfoJl8DmR75ingf4rvLkagXfp1dmzNmwQ1mvzT3Og5pEas9Ql5uGijoP6aib9glpe3yMcC8CjgEGRpN5JqhPKrQyho2K4ZRY0WiZpcNNwGIBVEVDZQYukKJhrMcdJjM8wVUedcE5xjzYRQO7N7OiPL60zhN20SDnZpnPShxYkgWyVuAg5zHUF3n';

const authService = {
    initToken() {
        return localStorage.setItem('ACCESS_TOKEN', token);
    },
    getToken() {
        return localStorage.getItem('ACCESS_TOKEN');
    }
}

export default authService;