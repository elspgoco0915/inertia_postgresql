<template>
  <elerning-layout>
    <div>
       <!-- コンテンツ -->
       <h2 class="text-gray-700 text-3xl font-medium">学習状況</h2>
       <p>{{ test }}</p>
       <!-- -->
    </div>
    
    <!-- vue3 draggable@next -->
    <div class="hello">
        <draggable v-model="data" group="people" item-key="id" handle=".handle" ghost-class="ghost" class="for_grid" @start="startDrag">
            <template #item="{element}">
                    <div class="grid_items">
                        <Link :href="route('course.detail', { id : element.id }  )" class="link">
                        <span class="handle">[drag area]</span>
                        {{ element.id }}
                        </Link>
                    </div>
            </template>
        </draggable>
    </div>

    <!-- modal -->
    <!-- <div>
        <dialog-modal :show="isopen" @close="isopen = false">
            <template #title>
                ダイアログタイトル
            </template>

            <template #content>
                {{time}}
            </template>

            <template #footer>

                <secondary-button @click.native="isopen = false">
                    はい
                </secondary-button>

                <danger-button @click.native="cancel">
                    いいえ
                </danger-button>

            </template>

        </dialog-modal>
    </div> -->

  </elerning-layout>
</template>

<style scoped>
.link {
    background-color: #D5F9CC;
    border: 1px solid #CCC;
    width : 100% ;
    padding-top : 100% ;
}

.for_flex {
    /* flexの場合 */
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    justify-content: center;
    align-items: center;
    background-color: aqua;

}

.flex-item {
    background: rgb(233, 249, 255);
    margin: 10px 0;
    width: 30%;
}

.grid_items {
    background-color: #D5F9CC;
    border: 1px solid #CCC;
    width : 100% ;
    padding-top : 100% ;
    }

.for_grid {
    width: 75%;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 10px;
}

/* .ghost {
    display: block;
    background: rgb(233, 249, 255);
    margin: 10px 0;
    width: 30%;
} */

</style>

<script>
    import { defineComponent } from 'vue'
    import ElerningLayout from '@/Layouts/ElerningLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3'

    import draggable from 'vuedraggable'
    import DialogModal from '@/Jetstream/DialogModal.vue'

    export default defineComponent({
        components: {
          ElerningLayout,
          draggable,
          DialogModal,
          Link,
        },
        props: {
            test: String,
            time: String,
        //   info : Object,
        //   done : Boolean, 
        //   user_name : String,
        },
        data() {
            return {
                // modal用
                isopen : true,
                // draggable用
                data: [
                    {
                        id: 1,
                        content: "テスト1",
                    },
                    {
                        id: 2,
                        content: "テスト2",
                    },
                    {
                        id: 3,
                        content: "テスト3",
                    },
                    {
                        id: 4,
                        content: "テスト4",
                    },
                    {
                        id: 5,
                        content: "テスト5",
                    },
                    {
                        id: 6,
                        content: "テスト6",
                    },
                    {
                        id: 7,
                        content: "テスト7",
                    },
                    {
                        id: 8,
                        content: "テスト8",
                    },
                    {
                        id: 9,
                        content: "テスト9",
                    },
                ],
            }
        },
        methods: {
            // TODO:ドラッグ時の画像非表示にしたい
            startDrag(event) {
                console.log(event);
            },
            cancel(){
                console.log("cancel");
            }

        },
    })
</script>