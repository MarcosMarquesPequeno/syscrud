<script setup>
    import { useAuthStore } from "@/stores/auth";
    import { storeToRefs } from "pinia";
    import { onMounted, reactive, ref } from "vue";
    import { useRoute, useRouter } from "vue-router";
    
    const router = useRouter();
    const route = useRoute();
    const { user } = storeToRefs(useAuthStore());
    const { getUser, updateUser } = usePostsStore();
    
    const UpUser= ref(null);
    
    const formData = reactive({
      name: "",
      cpf: "",
      email:"",
      password: "",
    });
    
    onMounted(async () => {
        UpUser.value = await getUser(route.params.id);
    
      if (user.value.id !== UpUser.value.user_id) {
        router.push({ name: "home" });
      } else {
        formData.name = UpUser.value.name;
        formData.cpf = UpUser.value.cpf;
        formData.email = UpUser.value.email;
        formData.password = UpUser.value.password;
      }
    });
    </script>
    
    <template>
      <main>
        <h1 class="title">Atualizar dados</h1>
    
        <form
          @submit.prevent="updateUser(UpUser, formData)"
          class="w-1/2 mx-auto space-y-6"
        >
        <div>
            <input type="text" placeholder="Name" v-model="formData.name" />
            <p v-if="errors.name" class="error">{{ errors.name[0] }}</p>
          </div>

          <div>
            <input type="text" placeholder="CPF" v-model="formData.cpf" />
            <p v-if="errors.cpf" class="error">{{ errors.cpf[0] }}</p>
          </div>
    
          <div>
            <input type="text" placeholder="Email" v-model="formData.email" />
            <p v-if="errors.email" class="error">{{ errors.email[0] }}</p>
          </div>
    
          <div>
            <input
              type="password"
              placeholder="Password"
              v-model="formData.password"
            />
            <p v-if="errors.password" class="error">{{ errors.password[0] }}</p>
          </div>
    
          <div>
            <input
              type="password"
              placeholder="Confirm Password"
              v-model="formData.password_confirmation"
            />
          </div>
    
          <button class="primary-btn">Update</button>
        </form>
      </main>
    </template>