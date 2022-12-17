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
            <b-card class="" :style="{height: lessonViewHeight()}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 text-left">
                            <h3 class="mt-2">{{ currentVideo.moduleTitle }} ({{currentVideo.title}})</h3>
                            <b-card-body class="px-0" style="font-size:1.1em" v-html="currentVideo.description"></b-card-body>
                        
                            <course-quiz-questions @send-new-completed-course="emitCompletedCourse"  @quiz-ended="markLessonCompleted" 
                            :course-data="courseData" :quiz-data="quizData"  
                            :quiz="currentVideo" id="newguy"></course-quiz-questions>
                            
                            <div v-if="currentVideo.completed && !currentVideo.lesson_resource.retake_on_request"><strong>This Assessment has already been taken</strong>. <em>You can view BUT you can't re-take and re-submit it</em></div>
                            <div v-if="currentVideo.completed && currentVideo.lesson_resource.retake_on_request"><strong>This Assessment has already been taken</strong>. <em>You can view, re-take and re-submit it</em></div>
                        </div>
                    </div>
                </div>
                <b-icon v-if="currentVideo.index !== 0" class="ml-3 chevron-style" @click="togglePreviousVideo(currentVideo.index)" title="Go to Previous Course" icon="chevron-left" style="top:40%;left:0; position:absolute">Previous</b-icon>
            
                <b-icon v-if="(currentVideo.index + 1) !== videoLength" class="chevron-style chevron-next" @click="toggleNextVideo(currentVideo.index)" title="Go to Next Course" icon="chevron-right" style="top:40%;right:0;position:absolute">Next</b-icon>
<!--
                <b-button @click="callModal(currentVideo.id,currentVideo.lesson_resource.id)"><b-icon icon="question-octagon-fill" aria-hidden="true"></b-icon> Open Assessment Questions</b-button>
-->
            </b-card>
        </div>
        <div class="video-section pl-1" style="position:relative;" v-else-if="this.currentVideo.lesson_type === 'scheduler'">
            <b-card class="" :style="{height: lessonViewHeight()}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 text-left">
                            <h3 class="mt-2">{{ currentVideo.moduleTitle }} ({{currentVideo.title}})</h3>
                            <b-card-body class="px-0" style="font-size:1.1em" v-html="currentVideo.schedule_instruction"></b-card-body>
                            <div>
                                <a v-if="!currentVideo.completed" class="btn btn-primary text-white" @click.prevent="launchScheduler">Launch Scheduler</a>
                                <a v-else class="btn btn-primary text-white" @click.prevent="launchScheduler">Manage Schedule</a>
                                <a id="openScheduler" class="d-none" :href="scheduleUrl" target="_blank">Open Scheduler</a>
                                
    <b-modal h-100 hide-footer hide-header-close no-close-on-backdrop no-close-on-esc :id="'modal-lg-new'+currentVideo.id" size="xl" :title="'Schedule Manager'">
    </b-modal>                                
                                
                            </div>
                        
                            <div v-if="currentVideo.completed"><strong>You have already scheduled a time for this activity.</strong>. <em>.</em></div>
                        </div>
                    </div>
                </div>
                <b-icon v-if="currentVideo.index !== 0" class="ml-3 chevron-style" @click="togglePreviousVideo(currentVideo.index)" title="Go to Previous Course" icon="chevron-left" style="top:40%;left:0; position:absolute">Previous</b-icon>
            
                <b-icon v-if="(currentVideo.index + 1) !== videoLength" class="chevron-style chevron-next" @click="toggleNextVideo(currentVideo.index)" title="Go to Next Course" icon="chevron-right" style="top:40%;right:0;position:absolute">Next</b-icon>
<!--
                <b-button @click="callModal(currentVideo.id,currentVideo.lesson_resource.id)"><b-icon icon="question-octagon-fill" aria-hidden="true"></b-icon> Open Assessment Questions</b-button>
-->
            </b-card>
        </div>
        <div class="video-section pl-1" style="position:relative;" v-else-if="this.currentVideo.lesson_type === 'project'">
            <b-card class="" :style="{height: lessonViewHeight()}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 text-left">
                            <h3 class="mt-2">{{ capitalize(currentVideo.lesson_type) }}: {{ currentVideo.moduleTitle }} ({{currentVideo.title}})</h3>
                            <b-card-body class="px-0" style="font-size:1.1em" v-html="currentVideo.project_details"></b-card-body>
                            <div>
                                <button class="btn btn-primary">Start Project</button>
                                <button class="btn btn-primary d-none">Manage Schedule</button>
                            </div>
                        
                            <div v-if="currentVideo.completed && !currentVideo.lesson_resource.retake_on_request"><strong>You have already scheduled a time for this activity.</strong>. <em>.</em></div>
                        </div>
                    </div>
                </div>
                <b-icon v-if="currentVideo.index !== 0" class="ml-3 chevron-style" @click="togglePreviousVideo(currentVideo.index)" title="Go to Previous Course" icon="chevron-left" style="top:40%;left:0; position:absolute">Previous</b-icon>
            
                <b-icon v-if="(currentVideo.index + 1) !== videoLength" class="chevron-style chevron-next" @click="toggleNextVideo(currentVideo.index)" title="Go to Next Course" icon="chevron-right" style="top:40%;right:0;position:absolute">Next</b-icon>
<!--
                <b-button @click="callModal(currentVideo.id,currentVideo.lesson_resource.id)"><b-icon icon="question-octagon-fill" aria-hidden="true"></b-icon> Open Assessment Questions</b-button>
-->
            </b-card>
        </div>
        <div v-else class="video-section pl-1" style="position:relative">
            <b-icon v-if="currentVideo.index !== 0" class="ml-3 chevron-style" @click="togglePreviousVideo(currentVideo.index)" title="Go to Previous Course" icon="chevron-left" style="top:40%;left:0; position:absolute;z-index:1">Previous</b-icon>
            <b-icon v-if="(currentVideo.index + 1) !== videoLength" class="chevron-style chevron-next" @click="toggleNextVideo(currentVideo.index)" title="Go to Next Course" icon="chevron-right" style="top:40%;right:0;position:absolute;z-index:1">Next</b-icon>
            
<!--
            <div v-if="currentVideoType=='youtube'" class="plyr__video-embed" id="player">
              <iframe
                :src="reformatAssetURL(currentVideo.lesson_resource.asset_url)"
                allowfullscreen
                allowtransparency
                allow="autoplay"
              ></iframe>
            </div>     
-->
            <vue-plyr ref="plyr" v-if="currentVideoType=='youtube'">
              <div class="plyr__video-embed">
                <iframe
                    :src="reformatAssetURL(currentVideo.lesson_resource.asset_url)"
                  allowfullscreen
                  allowtransparency
                  allow="autoplay"
                ></iframe>
              </div>
            </vue-plyr>
                       
<!--            <div v-if="currentVideoType=='youtube'" id="player" data-plyr-provider="youtube" :data-plyr-embed-id="extractYoutubeVideoId(currentVideo.lesson_resource.asset_url)"></div>             -->
<!--
            <iframe v-if="currentVideoType=='youtube'" class="w-100" height="558" :src="reformatAssetURL(currentVideo.lesson_resource.asset_url)" title="Media Player" 
            frameborder="0" allow="accelerometer; autoplay 'none'; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen></iframe>
-->

<!--
            <video id="player" playsinline controls data-poster="#">
                <source :src="reformatAssetURL(currentVideo.lesson_resource.asset_url)" type="video/mp4" />
            </video>
-->
<!--
            <video id="player" v-else-if="currentVideoType == 'mp4-normal'" class="video-cover" height="558" controlsList="nodownload" :src="reformatAssetURL(currentVideo.lesson_resource.asset_url)" playsinline controls data-poster="#"></video>
-->
            
            <vue-plyr ref="plyr" v-else>
                <video playsinline controls crossorigin data-poster="https://via.placeholder.com/1000x650.jpg?text=Video" controlsList="nodownload">
                    <source :src="reformatAssetURL(currentVideo.lesson_resource.asset_url)" type="video/mp4" />
                </video>
            </vue-plyr>
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
            scheduleData: [],
            scheduleUrl: '',
        }
    },
    watch: {
        currentVideo: function(newVal, oldVal) {
            // console.log(newVal)
            if(newVal.lesson_type === 'quiz'){
                this.processQuiz(newVal)
            }
            if(newVal.lesson_type === 'video'){
                this.currentVideoURL = this.currentVideo.lesson_resource.asset_url.toString();
                // this.setCurrentVideoType()
            }
        }
    },
    methods: {
        reformatAssetURL(asset_url) {
            let url = asset_url.toString();
            console.log(url)
            if (url.indexOf("youtube") > -1) {
                return this.reformatVideoYoutubeURL(url);
            }

            return url;
        },
        reformatVideoYoutubeURL(video_url) {
            let video = video_url.toString();
            if (video.indexOf("watch?v=") > -1) {
                let video_split = video.split("watch?v=");
                video = "https://www.youtube.com/embed/" + video_split[1] + '?origin=https://plyr.io&iv_load_policy=3&modestbranding=1&playsinline=1&showinfo=0&rel=0&enablejsapi=1';
            }
            return video
        },
        extractYoutubeVideoId(video_url) {
            let video = video_url.toString();
            if (video.indexOf("watch?v=") > -1) {
                let video_split = video.split("watch?v=");
                video = video_split[1];
            }
            return video
        },
        setCurrentVideoType(){
            let url = this.currentVideoURL;
            console.log('here')
            if (url.indexOf("youtube") > -1) {
                this.currentVideoType = 'youtube';
            }
            if (url.indexOf("mp4") > -1) {
                this.currentVideoType = 'mp4-normal';
            }
        },
        emitCompletedCourse(payload) {
            this.$emit('send-new-updated-content', payload)
        },
        processQuiz(payload) {
            // this.$bvModal.show('modal-lg-new'+modalId);
            let loader = Vue.$loading.show();
            let quizId = payload.lesson_resource.id
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
        launchScheduler() {
            let loader = Vue.$loading.show();
            axios
                .get(`/learner/courses/${this.courseData.id}/lesson/${this.currentVideo.id}/launch-scheduler`)
                .then((res) => {
                    this.scheduleData = res.data.schedules
                    this.scheduleUrl = res.data.url
                    // console.log(this.scheduleUrl)
                    // window.open(res.data.url,'_blank')
                    setTimeout(() => {
                        document.getElementById("openScheduler").click();
                    },300)
                    loader.hide();
                    setTimeout(() => {
                        this.recordSchedule()
                    },1000)
                    // console.log(this.$refs.quizRef)
                })
                .catch(() => {
                    loader.hide();
                })
        },
        recordSchedule() {
            let loader = Vue.$loading.show();
            swal({
                title: "Are you done scheduling?",
                // text: "If you've completed your schedule",
                icon: "question",
                buttons: [true,"Yes"],
            }).then((result) => {
                if (result) {
                    this.markLessonCompleted()
                } else {
                    loader.hide();
                }
            });
        },
        callModal(modalId, quizId) {
            // this.$bvModal.show('modal-lg-new'+modalId);
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
                for (let i = 0; i < pagination.length; i++) {
                    if(pagination[i].completed == false){
                        this.currentVideo = pagination[i]
                        return pagination
                    }
                }
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
        markLessonCompleted() {
            this.$emit('lesson-ended', this.currentVideo)
        },
        lessonViewHeight(){
            if(this.currentVideo.lesson_type !== 'video'){
                return 'unset'
            }

            return '40vh'
        },
        capitalize(word){
            return word[0].toUpperCase() + word.slice(1).toLowerCase();
        }
    },
    created() {
        // this.getAllVideo()
        this.filterAllVideo()
        this.videoLength = Object.keys(this.filterAllVideo()).length
        this.currentVideoURL = this.currentVideo.lesson_resource.asset_url.toString();
    },
    mounted() {
        this.callFirstCourseContent()
        this.$refs.plyr.player.on('ended', (event) => {
            this.markLessonCompleted()
        });

    },
    computed: {
        currentVideoType() {
            let url = this.currentVideoURL;
            if (url.indexOf("youtube") > -1) {
                return "youtube";
            }
            if (url.indexOf("mp4") > -1) {
                return "mp4-normal";
            }
            // <video> tan not looking nice. Side arrows clicki events not going through
            return "youtube";
        }
    },
    // width="1030" height="360" <video class="video-cover" src="../assets/video/video1.mp4" controls></video>
})