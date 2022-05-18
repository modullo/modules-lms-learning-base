Vue.component('course-quiz-questions', {
    props: {
        quiz: {
            type: Array,
        },
        quizData: {
            type: Array,
        },
        courseData: {
            type: Array,
        }
        // @shown="getAllQuestions(quiz.lesson_resource.id)"
    },
    template: 
    `
    <div>
    <b-modal h-100 hide-footer hide-header-close no-close-on-backdrop no-close-on-esc :id="'modal-lg-new'+quiz.id" size="xl" :title="quizData.title">
        <h6>Graded Quiz : 30mins | Total Points 6</h6>
        <h3 class="mt-3">Questions</h3>
        <b-form @submit.prevent="submitQuiz">
            <ol class="mt-2">
                <li v-for="(question, questionIndex) in quizData.questions" :key="questionIndex">
                    <span v-html="question.question_text"></span>
                    <b-list-group class="mb-3" v-if="question.question_type !== 'case_study'">
                        <b-list-group-item v-for="(option, optionIndex) in question.options" :key="optionIndex">
                            <input type="radio" 
                            :name="'question'+questionIndex" 
                            :id="'question'+question.id+optionIndex"
                            :value="option"  
                            v-model="userAnswers[question.id]"/>
                            <label :for="'question'+question.id+optionIndex">{{option}}</label>
                        </b-list-group-item>
                    </b-list-group>
                    <div v-else>
                        <textarea :id="'question'+question.id+optionIndex" v-model="userAnswers[question.id]" cols="5" rows="4" class="form-control">
                        </textarea>
                    </div>
                </li>
            </ol>
            <hr>
            <div class="float-right">
            <b-button class="btn btn-outline-danger m-r-2" @click="$bvModal.hide('modal-lg-new'+quiz.id)" v-b-modal.modal-footer-sm>cancel</b-button>
            <b-button class="btn btn-outline-secondary" type="submit">submit</b-button>
            </div>
        </b-form>
    </b-modal>
    </div>
    `,
    data() {
        return {
            options: [
                { text: 'Knowing is not half the battle', value: 'first' },
                { text: 'Our minds always deliver accurate information to us', value: 'second' },
                { text: 'visual illusions to make a point', value: 'third' }
            ],
            selected: '',
            selected1: '',
            selected2: '',
            quizQuestions: 'Mudah',
            userAnswers: [],
        }
    },
    computed: {
        computeQuestionsOptions(options) {
            const questionOptions = this.courseData.modules.map((module) => {
                return {
                    value: module.id,
                    text: module.title,
                }
            })
            return questionOptions
        }
    },
    watch: {
        quiz: function(newVal, oldVal) {
            console.log(newVal)
        }
    },
    methods: {
        getAllQuestions(quizId) {
            if (!this.quizData.length > 0) {
                
                let loader = Vue.$loading.show();
                axios
                .get(`/learner/courses/fetchQuiz/${quizId}`)
                .then((res) => {
                    loader.hide();
                    this.quizData = res.data.quiz
                    return
                    // console.log(this.$refs.quizRef)
                })
                .catch(() => {
                    loader.hide();
                })
            }
        },
        submitQuiz() {
            this.quizData.questions.forEach(element => {
                element.user_answer = this.userAnswers[element.id]
            });
            this.quizData.course_id = this.courseData.id
            let loader = Vue.$loading.show();
            axios
            .post(`/learner/courses/submitQuiz/${this.quizData.id}/${this.quiz.id}`, this.quizData)
            .then((res) => {
                this.$bvModal.hide('modal-lg-new'+this.quiz.id)
                this.$emit('send-new-completed-course', res.data.course)
                loader.hide();
                return
                // console.log(this.$refs.quizRef)
            })
            .catch(() => {
                loader.hide();
            })
        }
    },
})