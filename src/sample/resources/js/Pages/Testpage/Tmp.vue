<template>
  <elerning-layout>
    <div>
       <!-- コンテンツ -->
       <h2 class="text-gray-700 text-3xl font-medium">学習状況</h2>
       <p>{{ test }}</p>
       <!-- -->
    </div>

  </elerning-layout>
</template>

<style scoped>

</style>

<script>
    import { defineComponent } from 'vue'
    import ElerningLayout from '@/Layouts/ElerningLayout.vue'

    export default defineComponent({
        components: {
          ElerningLayout,
        },
        props: {
            test: String,
        },
        data() {
            return {
            }
        },
        methods: {
        },
    })
</script>