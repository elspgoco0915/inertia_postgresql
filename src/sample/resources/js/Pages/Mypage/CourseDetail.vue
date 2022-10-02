<template>
  <elerning-layout>
    <div>
    <!-- コンテンツ -->
        <div v-html="detail"></div>

        <form @submit.prevent="submit" class="mt-5">
            <div>
                <jet-label for="done" value="学習完了" />
                <jet-input id="done" type="hidden" v-model="form.done" value="true" />
            </div>
            <div v-if="info.done == 1">
                 <jet-button :disabled="true">
                     完了済
                 </jet-button>
             </div>
             <div v-else>
                <jet-button :disabled="form.processing">
                    学習を完了する
                </jet-button>
            </div>
        </form>
    </div>
</elerning-layout>

</template>


<script>
    import { defineComponent } from 'vue'
    import ElerningLayout from '@/Layouts/ElerningLayout.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetButton from '@/Jetstream/Button.vue'

    export default defineComponent({
        components: {
            JetButton,
            JetInput,
            JetLabel,
            ElerningLayout,
        },
        props: {
            info : Object,
            detail : String,
        },
        data() {
            return {
                form: this.$inertia.form({
                    // token: this.token,
                    course_id: this.info.id,
                    done: false,
                }),
                id: 1,
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('course.done',this.id), {
                    // onFinish: () => this.form.reset(),
                    onSuccess: () => this.info.done = true,
                    onError: () => alert("エラーが発生しました"),
                })
            }
        },
    })
</script>
