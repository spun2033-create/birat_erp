<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold">System Settings</h1>
    <div class="mt-4">
      <label class="flex items-center">
        <input type="checkbox" v-model="modules.inventory" />
        <span class="ml-2">Inventory module</span>
      </label>
      <label class="flex items-center mt-2">
        <input type="checkbox" v-model="modules.attendance" />
        <span class="ml-2">Attendance module</span>
      </label>
      <div class="mt-4">
        <label>Language:</label>
        <select v-model="language">
          <option value="ne">Nepali</option>
          <option value="en">English</option>
        </select>
      </div>
      <div class="mt-4">
        <button @click="save" class="btn btn-primary">Save Settings</button>
      </div>
      <div v-if="message" class="mt-2 text-green-600">{{ message }}</div>
      <div v-if="error" class="mt-2 text-red-600">{{ error }}</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      modules: { inventory: true, attendance: true },
      language: 'ne',
      message: null,
      error: null,
    }
  },
  mounted() {
    // Load current settings from API
    fetch('/api/settings')
      .then(r => r.json())
      .then(data => {
        if (data && data.data) {
          const s = data.data;
          if (s.modules) this.modules = s.modules;
          if (s.language) this.language = s.language;
        }
      }).catch(err => {
        console.error('Failed to load settings', err);
      });
  },
  methods: {
    save() {
      this.message = null;
      this.error = null;
      const payload = { settings: { modules: this.modules, language: this.language } };
      fetch('/api/settings', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      })
      .then(r => r.json())
      .then(data => {
        if (data && data.data) {
          this.message = 'Settings saved.';
        } else if (data && data.error) {
          this.error = data.error;
        }
      }).catch(err => {
        this.error = 'Failed to save settings.';
        console.error(err);
      });
    }
  }
}
</script>
