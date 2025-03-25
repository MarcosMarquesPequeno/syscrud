import { defineStore } from "pinia";
import { useAuthStore } from "./auth";

export const userStore = defineStore("userStore", {
  state: () => {
    return {
      errors: {},
    };
  },
  actions: {
    /******************* buscar todos *******************/
    async getAllUsers() {
      const res = await fetch("/api/users");
      const data = await res.json();

      return data;
    },
    /******************* buscar a user *******************/
    async getUser(users) {
      const res = await fetch(`/api/users/${users.id}`);
      const data = await res.json();

      return data.post;
    },
    /******************* Delete users *******************/
    async deleteUser(delUser) {
      const authStore = useAuthStore();
      if (authStore.user.id === delUser.user_id) {
        const res = await fetch(`/api/users/${delUser.id}`, {
          method: "delete",
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        });

        const data = await res.json();
        if (res.ok) {
          this.router.push({ name: "home" });
        }
        console.log(data);
      }
    },
    /******************* Update a post *******************/
    async updateUsers(user, formData) {
      const authStore = useAuthStore();
      if (authStore.user.id === user.user_id) {
        const res = await fetch(`/api/users/${user.id}`, {
          method: "put",
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
          body: JSON.stringify(formData),
        });

        const data = await res.json();
        if (data.errors) {
          this.errors = data.errors;
        } else {
          this.router.push({ name: "home" });
          this.errors = {}
        }
      }
    },
  },
});