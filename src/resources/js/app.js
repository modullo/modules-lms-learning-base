$(document).ready(function(){
    $(".owl-carousel").owlCarousel();
});


Vue.component('courses-carousel', {
    template: 
    `
    <div>
        <div class="mt-4 justify-content-cente h-100">
            <div class="searchbar">
            <input class="search_input" @change="filterAllCourses" v-model="searchQuery" type="text" name="" placeholder="Search For Your Course...">
            <a href="#" class="search_icon"><i class="fa fa-search"></i></a>
            <div style="position:absolute; z-index: 20; width:inherit" class="card mt-2 mx-auto" v-if="searchQuery">
                    <div class="card-body" v-for="(course, courseIndex) in filterAllCourses()" :key="courseIndex">
                        <img class="card-img-top" style="height: 50px; width:50px; object-fit: cover" :src="course.course_image" alt="Card image cap">
                        <span class="ml-3">{{course.title}}</span>
                        <span clas="d-flex justify-content-between">
                        <a :href="'/learner/courses/'+course.id" style="background-color: #495057; color: white;" class="float-right btn-style btn ml-3">View</a>
                        <a :href="'/learner/courses/'+course.id+'/assessment/'+course.title" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                        </span>
                    </div>
            </div>
            </div>
        </div>
        <h2 v-if="user" class="pl-4 font-weight-bold" style="margin-top: 2em">Let's start learning, {{user.first_name + ' ' + user.last_name}}</h2>
        <div v-for="(item, index) in allCourses" :key="index">
            <h3 class="p-3 pl-4 font-weight-bold">Top courses in <a href="" style="color: blue">{{ item.title}} </a></h3>
            <div class="row visible-courses">
                <div class="col-12">
                <div :id="'myCarousel'+index" class="carousel slide" data-ride="carousel" data-interval="0">
                    <div class="carousel-inner">
                        <div v-for="(lessonGroup, id) in chunk(item.courses, 4)" :key="id" class="carousel-item" :class="{active: checkActiveClass(id)}">
                            <div class="mb-5 row">
                                <div v-for="(lesson, id) in lessonGroup" :key="id" class="col-md-4 mb-5 col-lg-3">
                                    <div class="card h-60">
                                        <img class="card-img-top" style="height: 180px; width:auto; object-fit: cover" :src="lesson.course_image" alt="Card image cap">
                                        <div class="card-body">
                                        <h6 style="font-size: .9em; font-weight: bold;">{{lesson.title}}</h6>
                                        <small v-html="lesson.description"></small>
                                        <div><span class="checked rating-value">{{lesson.star}} </span><span class="ratings fa fa-star checked"></span>
                                            <span class="ratings fa fa-star checked"></span>
                                            <span class="ratings fa fa-star checked"></span>
                                            <span class="ratings fa fa-star"></span>
                                            <span class="ratings fa fa-star"></span></div>
                                            <div class="price mt-1">
                                                <span>₦12,000 <span class="old-price">₦15,000</span></span>
                                            </div>
                                            <div class="mt-1 rated">
                                                <span>Highest Rated</span>
                                            </div>
                                            <div class="mt-3 button-style">
                                                <a :href="'/learner/courses/'+lesson.id" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                                <a :href="'/learner/courses/'+lesson.id+'/assessment/'+lesson.title" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel controls -->
                    <a class="carousel-control-prev" v-if="item.courses.length > 4" :href="'#myCarousel'+index" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control-next" v-if="item.courses.length > 4" :href="'#myCarousel'+index" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                </div>
            </div>
        </div>

    </div>
    `,
    data() {
        return {
                items: [
                    {
                        category: 'Web Development',
                        lessons: [
                            {                 
                                title: "MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Academia By Dr Allen Grey",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image: "https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A",
                            },

                            {
                                title: " objects and classes",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Evan you",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image:
                                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
                            },

                            {
                                title: " objects and classes",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Evan you",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image:
                                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
                            },

                            {                 
                                title: "MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Academia By Dr Allen Grey",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image: "https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A",
                            },
                        ]
                    },
                    {
                        category: 'Android Development',
                        lessons: [
                            {  
                                title: " objects and classes",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Evan you",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image:
                                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
                            },

                            {  
                                title: " objects and classes",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Evan you",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image:
                                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
                            },

                            {  
                                title: " objects and classes",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Evan you",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image:
                                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
                            },

                            {  
                                title: " objects and classes",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Evan you",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image:
                                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
                            },
                        ]
                    },
                    {
                        category: 'AI / Machine Learning',
                        lessons: [
                            {                    
                                title: " objects and classes",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Evan you",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image:
                                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
                            },
                            {                    
                                title: " objects and classes",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Evan you",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image:
                                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
                            },
                            {                    
                                title: " objects and classes",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Evan you",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image:
                                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
                            },
                            {                    
                                title: " objects and classes",
                                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                                author: "Evan you",
                                price: "$12.99",
                                oldPrice: "$99.78",
                                highest_rated: true,
                                star: 5,
                                image:
                                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
                            },
                        ]
                    }
                ],
            allCourses: [],
            allSearchableCourses: [],
            user: null,
            searchQuery: '',
        }
    },
    created() {
        this.fetchAllCourses()
    },
    methods: {
        checkActiveClass(index){
            if (index == 0) {
                return true
            }
        },
        fetchAllCourses() {
            let loader = Vue.$loading.show()
            axios.get('courses/all')
            .then(res => {
                loader.hide();
                // this.allCourses.map((course) => programs[course.program]
                //     ? programs[course.program].push(course) 
                //     : programs[course.program] = [
                //         course
                //     ]
                // )
                this.user = res.data.user
                this.allSearchableCourses = res.data.courses
                const programs = {}
                res.data.courses.map((course) => programs[course.program.title]
                    ? programs[course.program.title].push(course)
                    : programs[course.program.title] = [
                        course
                    ]
                )
                const programsArray = [];

                Object.keys(programs).map((key) => {
                    const program = {
                        title: key,
                        courses: programs[key]
                    };
                    programsArray.push(program);
                })
                this.allCourses = programsArray
            })
            .catch(e => {
                loader.hide();
                const errors = e.response.data.error
                if(e.response.data.error){
                    toastr["error"](e.response.data.error)
                }
                else if(e.response.data.validation_error){
                    Object.entries(e.response.data.validation_error).forEach(
                        ([, value]) => {
                            toastr["error"](value)
                        },
                    )
                }
            })
        },
        chunk(array, size) {
            const result =  [].concat.apply([],
                array.map((elem, i) => i % size ? [] : [array.slice(i, i + size)])
            );
            return result
        },
        filterAllCourses(){
            if (this.searchQuery) {
                return this.allSearchableCourses.filter(card => card.title.toLowerCase().match(this.searchQuery.toLowerCase())).slice(0, 6)
                // return this.allSearchableCourses.map((course) => {
                //     return course.courses.filter(card => card.title.toLowerCase().match(this.searchQuery.toLowerCase()))
                // })
            }
        }
    }
})


var app = new Vue({
    el:"#app",
    // delimiters: ['!{', '}!'],
    data: {
        aboutProgram:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, architecto!architecto!architecto! Sed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libero nihil id veniam illo voluptates non dicta debitis enim nam minim,Nesciunt voluptate sequi odit corporis laboriosam molestiae repellat labore, ducimus ad nulla voluptates reprehenderit quidem impedit. Debitis magnam quis voluptatum obcaecati, voluptates atque deleniti nobis. Illum quos laudantium nemo quo.",
    },

    computed: {
        atEndOfList() {
            return this.currentOffset <= (this.paginationFactor * -1) * ((this.items.length - 1) - this.windowSize)
        },
        atHeadOfList() {
            return this.currentOffset === 0
        }
    },


    methods: {
        moveCarousel(direction) {
            if (direction === 1 && !this.atEndOfList) {
                this.currentOffset -= this.paginationFactor
            } else if (direction === -1 && !this.atHeadOfList) {
                this.currentOffset += this.paginationFactor
            }
        }
    }
})