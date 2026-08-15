<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold">Day Book (दैनिक लेनदेन)</h1>
    <div class="mt-4">
      <button @click="load">Load</button>
    </div>
    <div v-if="rows.length">
      <table class="mt-4">
        <thead>
          <tr><th>Date</th><th>Type</th><th>Ref</th><th>Debit</th><th>Credit</th><th>Running</th></tr>
        </thead>
        <tbody>
          <tr v-for="r in rows" :key="r.ref">
            <td>{{ r.date }}</td>
            <td>{{ r.type }}</td>
            <td>{{ r.ref }}</td>
            <td class="right">{{ r.debit }}</td>
            <td class="right">{{ r.credit }}</td>
            <td class="right">{{ r.running_balance }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return { rows: [] }
  },
  methods: {
    load() {
      fetch('/api/reports/daybook')
        .then(r => r.json())
        .then(d => { this.rows = d.data; })
        .catch(e => console.error(e));
    }
  }
}
</script>
