Vue.component('sidebar-item', {
  props: {
    currentPlayingVideo: {
      type: Object,
      required: true
    },
    courseData: {
      type: Object,
      default: () => {},
    },
  },
  template: 
  `
  <div class="accordion">
    <b-card style="cursor:pointer;" v-for="(module, index) in courseData.modules" :key="index" no-body class="mb-1">
      <b-card-header v-b-toggle="'accordion-1' +index" style="display:block !important" header-tag="header" class="p-2 text-left" role="tab">
        <div block style="font-size: 1.08em !important;" class="text-left shadow-non module-title">{{module.title}}
          <b-icon class="float-right m-2 mr-3" icon="chevron-down"></b-icon>
        </div>
        <span class="module-duration-text" v-b-toggle="'accordion-1' +index">0 / {{courseData.length}} | 27min</span>
      </b-card-header>
      <b-collapse :id="'accordion-1' +index" :style="visibility(module.module_number)" visibl accordion="my-accordion" role="tabpanel">
        <b-card-body style="padding: 5px;">
          <chapter :course-data="courseData" :videos="module.lessons" :currentPlayingVideo="currentPlayingVideo" 
           @send-new-updated-content="collectNewCourseContent" ref="chapterRef" @change-video="check"></chapter>
        </b-card-body>
      </b-collapse>
    </b-card>

  </div>
  `,
  data() {
      return {
        count: 1,
        mevideos: [
          {
            index: 0,
            title: "Introduction",
            duration: '1 hr',
            url: "https://www.youtube.com/embed/viHILXVY_eU"
          },
          {
            index: 1,
            title: "Diving Deeper",
            duration: '5 min',
            url: "https://www.youtube.com/embed/3BDIwBAL1iI"
          },
          {
            index: 2,
            title: "Quiz Section",
          },
      ],
        videos: {
          items: [
            {
                id: 1,
                name: "Getting Started",
                count: 3,
                duration: 27,
                selected: 0,
                videos: [
                    {
                      index: 0,
                      title: "Introduction",
                      duration: '1 hr',
                      url: "https://www.youtube.com/embed/viHILXVY_eU"
                    },
                    {
                      index: 1,
                      title: "Diving Deeper",
                      duration: '5 min',
                      url: "https://www.youtube.com/embed/3BDIwBAL1iI"
                    },
                    {
                      index: 2,
                      title: "Quiz Section",
                    },
                ]
            },

            {
                id: 2,
                name: "Theoratical Overview",
                count: 3,
                duration: 10,
                videos: [
                    {
                      index: 0,
                      title: "New Course Clip",
                      duration: '4 hr',
                      url: "https://www.youtube.com/embed/nzV1NmhC7ik"
                    },
                    {
                      index: 1,
                      title: "Aknowledgement",
                      duration: '6 min',
                      url: "https://www.youtube.com/embed/4m-l-QpqxOo"
                    },
                    {
                      index: 2,
                      title: "Quiz Section",
                    },
                ]
            },
            
            {
                id: 3,
                name: "Implementation",
                count: 4,
                duration: 10,
                videos: [
                    {
                      index: 0,
                      title: "Abstraction Logic",
                      duration: '30 sec',
                      url: "https://www.youtube.com/embed/viHILXVY_eU"
                    },
                    {
                      index: 1,
                      title: "Data Status",
                      duration: '17 min',
                      url: "https://www.youtube.com/embed/4m-l-QpqxOo"
                    },
                    {
                      index: 2,
                      title: "Logic Control",
                      duration: '18 min',
                      url: "https://www.youtube.com/embed/zPuVjhBGPFE"
                    },
                    {
                      index: 3,
                      title: "Quiz Section",
                    },
                ]
            },
          ],
        },
      }
  },
  watch: {
    currentPlayingVideo: function(newVal, oldVal) {
      // this.$root.$emit('bv::toggle::collapse', 'accordion-10')
      // alert('Prop changed: ', newVal, ' | was: ', oldVal)
    }
  },
  methods: {
    check(payload) {
      this.$emit('send-video-to-sidebar', payload)
    },
    collectNewCourseContent(payload) {
      this.$emit('send-new-content-to-sidebar', payload)
    },
    visibility(video_id) {
      if (this.currentPlayingVideo.moduleNumber == video_id) {
        return 'display:block'
      }
      return 'display:none'
    },
    // Emit Event outside with new APi Course Data
  },
  mounted() {
    this.$root.$emit('bv::toggle::collapse', 'accordion-10')
  }
})