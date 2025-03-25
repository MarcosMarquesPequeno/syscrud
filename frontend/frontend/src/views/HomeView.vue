<script setup>
  import { onMounted, ref } from "vue";
  import { userStore } from "@/stores/users";
  
  // Instanciar a store corretamente
  const userStoreInstance = userStore();
  const users = ref([]);
  
  // Buscar usuários ao montar o componente
  onMounted(async () => {
    users.value = await userStoreInstance.getAllUsers();
  });
  </script>
  
  <template>
    <main>
      <h1 class="title">Lista de Usuários</h1>
  
      <div v-if="users.length > 0">
        <div v-for="user in users" :key="user.id" class="border-l-4 border-blue-1 pl-1 mb-2">
          <h2>{{ user.name }} - {{ user.email }}</h2>
        </div>
      </div>
      <p v-else>Nenhum usuário encontrado.</p>
    </main>
  </template>
  