Vue.component("chapter", {
    props: {
      videos: {
        type: Array,
        required: true,
      },
      courseData: {
        type: Array,
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
              <div v-if="video.lesson_type !== 'quiz'">
                  <div style="padding:5px;border-bottom: 1px solid #6c757d; !important;">
                      <div class="form-check">
                      <input v-if="video.completed" style="cursor:pointer" class="form-check-input" 
                          type="checkbox" onclick="return false;" :checked="video.completed" 
                          id="defaultCheck1">
                      <input v-else @click.once="completeCourse(video.id, courseData.id)" style="cursor:pointer" class="form-check-input" 
                          type="checkbox" onclick="return false;" :checked="video.completed" 
                          id="defaultCheck1">
                      <label class="form-check-label">
                          {{video.title}}
                      </label>
                      </div>
                      <b-icon class="pl-4" icon="play-circle-fill" aria-hidden="true"></b-icon> <span class="pl-3 small">{{video.duration}}</span>
                  </div>
              </div>
              <div v-if="video.lesson_type === 'quiz'" :class="{'chapter-select-video': true, selectedVideo: compute(video)}">
                      <quiz-questions @send-new-completed-course="emitCompletedCourse" 
                      :course-data="courseData" :quiz-data="quizData"  :quiz="video" :id="video.id"></quiz-questions>
  
                      <div style="padding:5px;border-bottom: 1px solid #6c757d; !important;">
                         <div class="form-check">
                          <input v-if="video.completed" style="cursor:pointer" class="form-check-input" 
                              type="checkbox" onclick="return false;" :checked="video.completed" 
                              id="defaultCheck1">
                          <input v-else @click.once="completeCourse(video.id, courseData.id)" style="cursor:pointer" class="form-check-input" 
                              type="checkbox" onclick="return false;" :checked="video.completed" 
                              id="defaultCheck1">
                          <label class="form-check-label">
                              {{video.title}}
                          </label>
                      </div>
                      <b-button @click="callModal(video.id,video.lesson_resource.id)" size="sm" class="m-2 small"><b-icon icon="question-octagon-fill" aria-hidden="true"></b-icon> Open Questions</b-button>
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
      };
    },
    computed: {},
    methods: {
      emitVideo(video) {
        this.$emit("change-video", video);
      },
      callModal(modalId, quizId) {
      let loader = Vue.$loading.show();
        this.$bvModal.show('modal-lg'+modalId);
        axios
         .get(`/learner/courses/fetchQuiz/${quizId}`)
         .then((res) => {
          loader.hide();
          this.quizData = res.data.quiz
          // console.log(this.$refs.quizRef)
         })
         .catch(() => {
          loader.hide();
         })
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
          })
          .catch((e) => {
            loader.hide();
          });
      },
    },
  });
  