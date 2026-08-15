<template>
  <div class="max-w-md mx-auto mt-16">
    <h1 class="text-2xl font-bold mb-4">Login</h1>
    <form @submit.prevent="submit">
      <div class="mb-2">
        <label class="block">Email</label>
        <input v-model="form.email" type="email" class="w-full border p-2" />
      </div>
      <div class="mb-2">
        <label class="block">Password</label>
        <input v-model="form.password" type="password" class="w-full border p-2" />
      </div>
      <div>
        <button class="btn btn-primary">Login</button>
      </div>
      <div v-if="error" class="text-red-600 mt-2">{{ error }}</div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: { email: '', password: '' },
      error: null
    }
  },
  methods: {
    submit() {
      fetch('/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
        body: JSON.stringify(this.form)
      }).then(r => {
        if (r.redirected) window.location = r.url;
        else return r.json();
      }).then(data => {
        if (data && data.errors) this.error = Object.values(data.errors).flat().join(', ');
      }).catch(e => { this.error = 'Login failed'; });
    }
  }
}
</script>
