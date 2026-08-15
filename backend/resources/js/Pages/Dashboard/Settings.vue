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
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      modules: { inventory: true, attendance: true },
      language: 'ne'
    }
  },
  methods: {
    save() {
      // TODO: call API to persist settings
      alert('Settings saved (placeholder)');
    }
  }
}
</script>
