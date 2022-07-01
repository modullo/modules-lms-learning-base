Vue.component('course-quiz-questions', {
    props: {
        quiz: {
            type: Object,
        },
        quizData: {
        },
        courseData: {
            type: Object,
        },
        // @shown="getAllQuestions(quiz.lesson_resource.id)"
    },
    template:
        `
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12 text-left">
                    <h6>Test Duration : 30mins | Total Points 6</h6>
                    <div v-if="quizStarted === false">
                        <button class="btn btn-primary" type="button" @click="quizStarted = true">Start Quiz</button>
                    </div>
                    <b-form v-if="quizStarted === true" @submit.prevent="submitQuiz" id="custom-step" class="mt-4">
                        <nav>
                            <div class="nav nav-tabs d-none" id="nav-tab">
                                <a v-for="(question, questionIndex) in quizData.questions" class="nav-link" :class="{active: setActiveQuestion(question.id)}" :id="question.id+'-tab'" data-bs-toggle="tab" :href="'#tab-'+question.id" @click="setActiveQuestion(question.id)">.</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div v-for="(question, questionIndex) in quizData.questions" :id="'tab-'+question.id" class="tab-pane " :class="{active: setActiveQuestion(question.id)}">
                                <h3>Question {{questionIndex+1}} of {{quizData.questions.length}}</h3>
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
                                <div class="">
                                    <button type="button" :id="'tab-'+question.id+'Prev'" class="btn float-start" :class="{'disabled': activeIsFirst(questionIndex),'btn-outline-secondary': activeIsFirst(questionIndex),'btn-secondary': !activeIsFirst(questionIndex)}" @click.stop="controlPrev(questionIndex,$event)">Previous</button>
                                    <button v-show="lastQuestionIndex != questionIndex" type="button" :id="'tab-'+question.id+'Next'" class="btn btn-primary float-end" @click.stop="controlNext(questionIndex,$event)">Next</button>
                                    <button v-show="lastQuestionIndex == questionIndex" type="submit" class="btn btn-success float-end">Submit</button>
                                </div>                                        
                            </div>
<!--
                            <div class="tab-pane active" id="step1">
                                <h4 class="card-title mt-3 mb-1">Seller Details</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtFirstNameBilling" class="col-lg-3 col-form-label text-end">Contact Person</label>
                                            <div class="col-lg-9">
                                                <input id="txtFirstNameBilling" name="txtFirstNameBilling" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtLastNameBilling" class="col-lg-3 col-form-label text-end">Mobile No.</label>
                                            <div class="col-lg-9">
                                                <input id="txtLastNameBilling" name="txtLastNameBilling" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtCompanyBilling" class="col-lg-3 col-form-label text-end">Landline No.</label>
                                            <div class="col-lg-9">
                                                <input id="txtCompanyBilling" name="txtCompanyBilling" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtEmailAddressBilling" class="col-lg-3 col-form-label text-end">Email Address</label>
                                            <div class="col-lg-9">
                                                <input id="txtEmailAddressBilling" name="txtEmailAddressBilling" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtAddress1Billing" class="col-lg-3 col-form-label text-end">Address 1</label>
                                            <div class="col-lg-9">
                                                <textarea id="txtAddress1Billing" name="txtAddress1Billing" rows="4" class="form-control"></textarea>
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtAddress2Billing" class="col-lg-3 col-form-label text-end">Warehouse Address</label>
                                            <div class="col-lg-9">
                                                <textarea id="txtAddress2Billing" name="txtAddress2Billing" rows="4" class="form-control"></textarea>
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtCityBilling" class="col-lg-3 col-form-label text-end">Company Type</label>
                                            <div class="col-lg-9">
                                                <input id="txtCityBilling" name="txtCityBilling" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtStateProvinceBilling" class="col-lg-3 col-form-label text-end">Live Market A/C</label>
                                            <div class="col-lg-9">
                                                <input id="txtStateProvinceBilling" name="txtStateProvinceBilling" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtTelephoneBilling" class="col-lg-3 col-form-label text-end">Product Category</label>
                                            <div class="col-lg-9">
                                                <input id="txtTelephoneBilling" name="txtTelephoneBilling" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtFaxBilling" class="col-lg-3 col-form-label text-end">Product Sub Category</label>
                                            <div class="col-lg-9">
                                                <input id="txtFaxBilling" name="txtFaxBilling" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;
                                <div class="">
                                    <button type="button" id="step1Next" class="btn btn-primary float-end">Next</button>
                                </div>                                        
                            </div>
                            <div class="tab-pane" id="step2">
                                <h4 class="card-title mt-3 mb-1">Company Document</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtFirstNameShipping" class="col-lg-3 col-form-label text-end">PAN Card</label>
                                            <div class="col-lg-9">
                                                <input id="txtFirstNameShipping" name="txtFirstNameShipping" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtLastNameShipping" class="col-lg-3 col-form-label text-end">VAT/TIN No.</label>
                                            <div class="col-lg-9">
                                                <input id="txtLastNameShipping" name="txtLastNameShipping" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtCompanyShipping" class="col-lg-3 col-form-label text-end">CST No.</label>
                                            <div class="col-lg-9">
                                                <input id="txtCompanyShipping" name="txtCompanyShipping" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtEmailAddressShipping" class="col-lg-3 col-form-label text-end">Service Tax No.</label>
                                            <div class="col-lg-9">
                                                <input id="txtEmailAddressShipping" name="txtEmailAddressShipping" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtCityShipping" class="col-lg-3 col-form-label text-end">Company UIN</label>
                                            <div class="col-lg-9">
                                                <input id="txtCityShipping" name="txtCityShipping" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtStateProvinceShipping" class="col-lg-3 col-form-label text-end">Declaration</label>
                                            <div class="col-lg-9">
                                                <input id="txtStateProvinceShipping" name="txtStateProvinceShipping" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;
                                <div>
                                    <button type="button" id="step2Prev" class="btn btn-secondary float-start">Previous</button>
                                    <button type="button" id="step2Next" class="btn btn-primary float-end">Next</button>
                                </div> 
                            </div>
                            <div class="tab-pane" id="step3">
                                <h4 class="card-title mt-3 mb-1">Bank Details</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtNameCard" class="col-lg-3 col-form-label text-end">Name on Card</label>
                                            <div class="col-lg-9">
                                                <input id="txtNameCard" name="txtNameCard" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="ddlCreditCardType" class="col-lg-3 col-form-label text-end">Credit Card Type</label>
                                            <div class="col-lg-9">
                                                <select id="ddlCreditCardType" name="ddlCreditCardType" class="form-select">
                                                    <option value="">&#45;&#45;Please Select&#45;&#45;</option>
                                                    <option value="AE">American Express</option>
                                                    <option value="VI">Visa</option>
                                                    <option value="MC">MasterCard</option>
                                                    <option value="DI">Discover</option>
                                                </select>
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtCreditCardNumber" class="col-lg-3 col-form-label text-end">Credit Card Number</label>
                                            <div class="col-lg-9">
                                                <input id="txtCreditCardNumber" name="txtCreditCardNumber" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtCardVerificationNumber" class="col-lg-3 col-form-label text-end">Card Verification Number</label>
                                            <div class="col-lg-9">
                                                <input id="txtCardVerificationNumber" name="txtCardVerificationNumber" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row mb-2">
                                            <label for="txtExpirationDate" class="col-lg-3 col-form-label text-end">Expiration Date</label>
                                            <div class="col-lg-9">
                                                <input id="txtExpirationDate" name="txtExpirationDate" type="text" class="form-control">
                                            </div>
                                        </div>&lt;!&ndash;end form-group&ndash;&gt;
                                    </div>&lt;!&ndash;end col&ndash;&gt;
                                </div>&lt;!&ndash;end row&ndash;&gt;
                                <div>
                                    <button type="button" id="step3Prev" class="btn btn-secondary float-start">Previous</button>
                                    <button type="button" id="step3Next" class="btn btn-primary float-end">Next</button>                                         
                                </div> 
                            </div>
                            <div class="tab-pane" id="step4">
                                <h4 class="card-title mt-3">Confirm Detail</h4>
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree with the Terms and Conditions.
                                    </label>                                           
                                </div> 
                                <div>
                                    <button type="button" id="step4Prev" class="btn btn-secondary float-start">Previous</button>
                                    <button type="button" id="step4Finish" class="btn btn-danger float-end">Finish</button>                                         
                                </div> 
                            </div>
-->
                        </div>
                    </b-form>
                </div>
            </div>
        </div>
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
            tabIndex: 1,
            activeQuestion: '',
            lastQuestionIndex: 0,
            quizStarted: false
        }
    },
    watch: {
        quizData: function(newVal, oldVal) {
            this.activeQuestion = newVal.questions[0].id
            this.lastQuestionIndex = newVal.questions.length - 1
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
    mounted: function() {
        // console.log(this.courseData) - working well
        // console.log(this.quiz)
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
        getCurrentQuizLesson() {
            return this.quiz;
        },
        submitQuiz() {
            this.quizData.questions.forEach(element => {
                element.user_answer = this.userAnswers[element.id]
            });
            this.quizData.course_id = this.courseData.id
            let loader = Vue.$loading.show();
            //console.log(this.quizData);
            axios
                .post(`/learner/courses/submitQuiz/${this.quizData.id}/${this.quiz.id}`, this.quizData)
                .then((res) => {
                    //console.log(res)
                    // this.$emit('send-new-completed-course', res.data.course)
                    this.$emit('quiz-ended')
                    loader.hide();
                    return
                    // console.log(this.$refs.quizRef)
                })
                .catch((e) => {
                    loader.hide();
                })
        },
        setActiveQuestion(questionId){
            return this.activeQuestion === questionId
        },
        controlPrev(index,event){
            if(this.activeIsFirst(index)){
                event.stopPropagation()
            }
            else{
                this.activeQuestion = this.quizData.questions[index-1].id
            }
        },
        controlNext(index,event){
            this.activeQuestion = this.quizData.questions[index+1].id
        },
        activeIsFirst(index){
            return index === 0
        },
    },
})