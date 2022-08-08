Vue.component("chapter", {
  props: {
    videos: {
      type: Array,
      required: true,
    },
    courseData: {
      type: Object,
      required: true,
    },
    currentPlayingVideo: {
      type: Object,
      required: true,
      default: {},
    },
  },
  template: `
    <div class="chapter-wrapper">
        <div v-if="videos.length === 0">
            <p>No Lesson in this Module</p>
        </div>
        <div v-for="(video, index) in videos" :key="index" :class="{'chapter-select-video': true, selectedVideo: compute(video)}"  @click="emitVideo(video)">
            <div :class="{'chapter-select-video': true, selectedVideo: compute(video)}">
                <div style="padding:5px;border-bottom: 1px solid #6c757d; !important;">
                    <div class="form-check">
                      <input v-if="video.completed" style="cursor:pointer" class="form-check-input" 
                          type="checkbox" onclick="return false;" :checked="video.completed" 
                          id="defaultCheck1">
                      <input v-else style="cursor:pointer" class="form-check-input" 
                          type="checkbox" onclick="return false;" :checked="video.completed" 
                          id="defaultCheck1">
                      <label class="form-check-label">
                          {{video.title}}
                      </label>
                    </div>
                    <div v-if="video.lesson_type === 'video'">
                      <b-icon class="pl-4" icon="play-circle-fill" aria-hidden="true"></b-icon> <span class="pl-3 small">{{video.duration}}</span>
                    </div>
                    <div v-else-if="video.lesson_type === 'quiz'">
                      <b-icon class="pl-4" icon="question-octagon-fill" aria-hidden="true"></b-icon> <span class="pl-3 small">Take Quiz - {{video.duration}}</span>
                    </div>
                    <div v-else-if="video.lesson_type === 'scheduler'">
                      <b-icon class="pl-4" icon="calendar3" aria-hidden="true"></b-icon> <span class="pl-3 small">Schedule - {{video.duration}}</span>
                    </div>
                    <div v-else-if="video.lesson_type === 'project'">
                      <b-icon class="pl-4" icon="briefcase" aria-hidden="true"></b-icon> <span class="pl-3 small">Project - {{video.duration}}</span>
                    </div>
                    <div v-else>
                      <b-icon class="pl-4" icon="clock" aria-hidden="true"></b-icon> <span class="pl-3 small">Others - {{video.duration}}</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    `,
  data() {
    return {
      status: "",
      datachange: false,
      quizData: [],
      currentLessonQuiz: ''
    };
  },
  computed: {},
  methods: {
    emitVideo(video) {
      this.$emit("change-video", video);
    },
    emitCompletedCourse(payload) {
      this.$emit('send-new-updated-content', payload)
    },
    compute(video) {
      // console.log(this.currentPlayingVideo)
      // this.$root.$emit('bv::toggle::collapse', 'accordion-1'+this.currentPlayingVideo.module)
      if (this.currentPlayingVideo.id === video.id) {
        return true;
      } else {
        return false;
      }
    },
    completeCourse(id, courseId) {
      let loader = Vue.$loading.show();
      axios
          .post(`/learner/courses/completeCourse/${id}`, {course_id: courseId})
          .then((res) => {
            // Emit event with course data
            loader.hide();
            //   console.log(res.data.course)
            this.$emit('send-new-updated-content', res.data.course)
            //   this.filteredData = res.data.data;
            alert('Lesson Marked as COMPLETED')
          })
          .catch((e) => {
            loader.hide();
          });
    },
  },
});
