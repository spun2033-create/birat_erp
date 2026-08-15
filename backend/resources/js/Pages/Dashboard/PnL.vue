<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold">Profit & Loss (नाफा/नोक्सान)</h1>
    <div class="mt-4">
      <button @click="load">Calculate</button>
    </div>
    <div v-if="result">
      <p>Sales: {{ result.sales }}</p>
      <p>Purchases: {{ result.purchases }}</p>
      <p>Gross: {{ result.gross }}</p>
      <p>Expenses: {{ result.expenses }}</p>
      <p>Net: {{ result.net }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() { return { result: null } },
  methods: {
    load() {
      fetch('/api/reports/pnl')
        .then(r => r.json())
        .then(d => { this.result = d.data; })
    }
  }
}
</script>
