<template>
  <elerning-layout>
    <div>
    <!-- コンテンツ -->
        <ul v-for="course in info.courses" :key="course.id">
            <li>
                <span v-if="course.done" class="text-emerald-500">完了</span>
                <span v-else class="text-rose-600">未完了</span>
                <Link :href="route('course.detail', { id : course.id }  )" class="mt-2">
                    【{{course.title}}】
                </Link>
            </li>
        </ul>
    <!-- -->
    </div>
  </elerning-layout>
</template>

<style scoped>

</style>

<script>
    import { defineComponent } from 'vue'
    import ElerningLayout from '@/Layouts/ElerningLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3'

    export default defineComponent({
        components: {
          ElerningLayout,
          Link,
        },
        props: {
          info : Object,
        },
        data() {
            return {

            }
        },
        methods: {

        },
    })
</script>
