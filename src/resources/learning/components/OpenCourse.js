Vue.component('open-course', {
    props: {
        courseData: {
            type: Object,
            default: () => {},
        },

    },
    template: 
    `
    <div>
        <div class="video-section pl-1" style="position:relative;" v-if="this.currentVideo.lesson_type === 'quiz'">
            <b-card class="text-center" style="height: 40vh;">
            <h3 class="mt-2">{{ currentVideo.moduleTitle }}: {{currentVideo.title}}</h3>
            <b-card-body style="font-size:1.1em" v-html="currentVideo.description">This is The Quiz Section, You can start taking the questions now...</b-card-body>
            <b-icon v-if="currentVideo.index !== 0" class="ml-3 chevron-style" @click="togglePreviousVideo(currentVideo.index)" title="Go to Previous Course" icon="chevron-left" style="top:40%;left:0; position:absolute">Previous</b-icon>
            <course-quiz-questions @send-new-completed-course="emitCompletedCourse" 
            :course-data="courseData" :quiz-data="quizData"  
            :quiz="currentVideo" id="newguy"></course-quiz-questions>
            
            <b-icon v-if="(currentVideo.index + 1) !== videoLength" class="chevron-style chevron-next" @click="toggleNextVideo(currentVideo.index)" title="Go to Next Course" icon="chevron-right" style="top:40%;right:0;position:absolute">Next</b-icon>
                <b-button @click="callModal(currentVideo.id,currentVideo.lesson_resource.id)"><b-icon icon="question-octagon-fill" aria-hidden="true"></b-icon> Open Quiz Section</b-button>
            </b-card>
        </div>
        <div v-else class="video-section pl-1" style="position:relative">
            <b-icon v-if="currentVideo.index !== 0" class="ml-3 chevron-style" @click="togglePreviousVideo(currentVideo.index)" title="Go to Previous Course" icon="chevron-left" style="top:40%;left:0; position:absolute">Previous</b-icon>
            <b-icon v-if="(currentVideo.index + 1) !== videoLength" class="chevron-style chevron-next" @click="toggleNextVideo(currentVideo.index)" title="Go to Next Course" icon="chevron-right" style="top:40%;right:0;position:absolute">Next</b-icon>
            
            <iframe v-if="currentVideoType=='youtube'" class="w-100" height="558" :src="reformatAssetURL(currentVideo.lesson_resource.asset_url)" title="Media Player" 
            frameborder="0" allow="accelerometer; autoplay 'none'; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen></iframe>

            <video v-else-if="currentVideoType=='mp4-normal'" class="video-cover" height="558" controlsList="nodownload" :src="reformatAssetURL(currentVideo.lesson_resource.asset_url)" controls></video>
            <br>
        </div>
    </div>
        `,
            // <span class="ml-5">{{currentVideo.url}} / {{currentVideo.title}}</span>
    data() {
        return{
            videos: {
                items: [
                    {
                        id: 1,
                        name: "Getting Started",
                        count: 3,
                        duration: 27,
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
                    }
                ],
            },
            count: '',
            currentVideo: '',
            currentVideoURL: '',
            videoLength: '',
            testView: '',
            quizData: [],
        }
    },
    methods: {
        reformatAssetURL(asset_url) {
            let url = asset_url.toString();
            if (url.indexOf("youtube") > -1) {
                return this.reformatVideoYoutubeURL(url);
            }


            return url;
        },
        reformatVideoYoutubeURL(video_url) {
            let video = video_url.toString();
            if (video.indexOf("watch?v=") > -1) {
                let video_split = video.split("watch?v=");
                video = "https://www.youtube.com/embed/" + video_split[1];
            }
            return video
        },
        emitCompletedCourse(payload) {
            this.$emit('send-new-updated-content', payload)
        },
        callModal(modalId, quizId) {
            this.$bvModal.show('modal-lg-new'+modalId);
            let loader = Vue.$loading.show();
            axios
            .get(`/learner/courses/fetchQuiz/${quizId}`)
            .then((res) => {
                this.quizData = res.data.quiz
                loader.hide();
            // console.log(this.$refs.quizRef)
            })
            .catch(() => {
            loader.hide();
            })
        },
        getAllVideo(single = null) {
            this.count = 0
            const pagination = this.videos.items.map((module) => {
                return module.videos.map((video) => {
                    video.index = this.count++;
                    video.module = module.id
                    video.moduleTitle = module.name
                    return video;
                })
            }).flat();
            if (single === null) {
                this.currentVideo = pagination[0]
                return pagination
            }
            return pagination
        },
        filterAllVideo(single = null) {
            this.count = 0
            const pagination = this.courseData.modules.map((module) => {
                return module.lessons.map((lesson) => {
                    lesson.index = this.count++;
                    lesson.moduleNumber = module.module_number
                    lesson.moduleTitle = module.title
                    return lesson;
                })
            }).flat();
            if (single === null) {
                this.currentVideo = pagination[0]
                return pagination
            }
            this.testView = pagination
            return pagination
        },
        togglePreviousVideo(index) {
            const count = 2 + 1
            if ((count) === Object.keys(this.filterAllVideo()).length) {
                // @de end
                // alert('end')
            }else {
                index = index - 1
                this.currentVideo = this.filterAllVideo(true).filter((video) => {
                    return video.index === index
                })[0]
                this.$emit('current-lesson', this.currentVideo)
            }
        },
        toggleNextVideo(index) {
            const count = 2 + 1
            if ((count) === Object.keys(this.filterAllVideo()).length) {
                // @de end
                alert('end')
            }else {
                this.currentVideo = this.filterAllVideo(true).filter((video) => {
                    return video.index === index + 1
                })[0]
                this.$emit('current-lesson', this.currentVideo)
            }
        },
        callFirstCourseContent() {
            this.$emit('current-lesson', this.currentVideo)
        },

    },
    created() {
        // this.getAllVideo()
        this.filterAllVideo()
        this.videoLength = Object.keys(this.filterAllVideo()).length
        this.currentVideoURL = this.currentVideo.lesson_resource.asset_url.toString();
    },
    mounted() {
        this.callFirstCourseContent()
    },
    computed: {
        currentVideoType() {
            let url = this.currentVideoURL;
            if (url.indexOf("youtube") > -1) {
                return "youtube";
            }
            // if (url.indexOf("mp4") > -1) {
            //     return "mp4-normal";
            // }
            return "youtube";
        }
    },
    // width="1030" height="360" <video class="video-cover" src="../assets/video/video1.mp4" controls></video>
})