<template>
  <qkyoku-layout>

{{ test }} 
    <div>
       <!-- コンテンツ -->
       <h2 class="text-gray-700 text-3xl font-medium">結果</h2>
      <ul v-for="item in items" :key="item">
      <!-- TODO: albumのみの条件 -->
        <!-- <li>{{ item.album_type }}</li> -->
        <!-- <li>{{ item.artists[0].name }}</li> -->
        <hr>
      <!-- 共通 -->
        <li>{{ item.name }}</li>
        <!-- <li>{{ item.images }}</li> -->
        <img v-if="item.images[0]" :src="item.images[0].url" alt="test" width="50" height="50">

      <!-- 見れる -->
        <!-- <li>{{ item.external_urls.spotify }}</li> -->
        <!-- <li>{{ item.uri }}</li> -->

        <li v-if="test == 'artist'">
          <Link as="button" :href="route('qkyoku.select',{ id: item.id })" method="get" :data="test" preserve-state 
              class="border border-gray-400 m-1 p-1 text-sm">
              Go to albums
          </Link>
        {{ item.id }}
        </li>

        <li v-if="test == 'album'">
          <Link as="button" :href="route('qkyoku.decide')" method="post" :data="{ id: item.id }" preserve-state 
              class="border border-gray-400 m-1 p-1 text-sm">
              Decide
          </Link>
        {{ item.id }}
        </li>



      </ul>

      <!-- <p v-if="is_album">testa</p> -->

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