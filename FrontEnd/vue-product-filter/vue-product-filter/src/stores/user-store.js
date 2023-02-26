import { defineStore } from "pinia";

export const useUserStore = defineStore({
  id: "user",
  state: () => ({
    name: 'Mohammed Nasser',
    age: 28,
    country: 'palestine',
  }),
  getters: {
    showUser: (state) => {
      return 'welcome ' + state.name + ' Your Age is ' + state.age + ' and Country is ' + state.country;
    },
  },
  actions: {
    changeName() {
      this.name = "Fadi Hassan"
    },
    changeAge() {
      this.age = 30
    }
  },
});
