var app = new Vue({
    el: '#app',
    data: {
      name: 'Musah Musah!',
    },
    methods: {
      setVideo(payload) {
        // alert('videos' + payload)
        this.$refs.childRef.currentVideo = payload
      },
      parentListenForLesson(payload) {
        this.$refs.sideContents.listener = payload
        this.$refs.sideContents.mobileResponse = payload
      }
    }
})