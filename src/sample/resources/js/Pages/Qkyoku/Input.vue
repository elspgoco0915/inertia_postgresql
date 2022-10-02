<template>
  <qkyoku-layout>
    <div>
       <!-- コンテンツ -->
       <h2 class="text-gray-700 text-3xl font-medium">結果</h2>
    <ul>

        <!-- <li>{{ items.tracks.items[0].track_number }}</li>
        <li>{{ items.tracks.items[0].name }}</li>
        <li>{{ items.tracks.items[0].id }}</li>
        <li>{{ items.tracks.items[0].preview_url }}</li> -->

        <li>{{ items.artists[0].name }}</li>
        <li>{{ items.name }}</li>
        <img v-if="items.images[0]" :src="items.images[0].url" alt="test" width="50" height="50">

        <li>{{ items.total_tracks }} tracks</li>
        <ul v-for="item in items.tracks.items" :key="item">
            <li>
                <input type="radio" id="test" name="radio" v-model="type" value="artist" checked>
                <label for="test">
                    {{ item.track_number }} |
                    {{ item.name }}         |
                    {{ item.id }}           |
                    {{ item.preview_url }}  |
                </label>
            </li>
        </ul>

        <form action="">
            <ul>
                <li><input type="text" value=""></li>
                <li><input type="textarea" value=""></li>
                <li><input type="button" value="submit"></li>
            </ul>
        </form>

        

<!-- <li>{{ items }}</li> -->

    </ul>


       <!-- <p>{{ imgurl }}</p> -->
       <!-- -->
    </div>
    
  </qkyoku-layout>
</template>

<style scoped>

</style>

<script>
    import { defineComponent } from 'vue'
    import QkyokuLayout from '@/Layouts/QkyokuLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3'

    import draggable from 'vuedraggable'
    import DialogModal from '@/Jetstream/DialogModal.vue'

    export default defineComponent({
        components: {
          // ElerningLayout,
          QkyokuLayout,
          draggable,
          DialogModal,
          Link,
        },
        props: {
            test: String,
            time: String,
            items: Array,
            imgurl: String,
            type: String,
        },
        data() {
            return {
            }
        },
        methods: {

        },
    })
</script>