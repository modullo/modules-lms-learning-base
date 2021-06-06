Vue.component('courses-carousel', {
    template: 
    `
    <div>
    <h2 class="pl-4 font-weight-bold" style="margin-top: 2em">Let's start learning, MusahMusah</h2>
    <div v-for="(item, index) in items">
        <h3 class="pl-4 p-3 font-weight-bold" :title="item.title">Top courses in <a href="" style="color: blue">{{ item.category }} </a></h3>
        <div class="row visible-courses">
            <div class="col-12">
            <div :id="'myCarousel'+index" class="carousel slide" data-ride="carousel" data-interval="0">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="mb-5 row">
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" :src="item.image" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">{{item.title}}</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-b.udemycdn.com/course/240x135/947098_02ec_2.jpg?secure=qxZQIYdwOP_NNodGcRfWtg%3D%3D%2C1622691213 1x, https://img-c.udemycdn.com/course/480x270/947098_02ec_2.jpg?Expires=1622691213&Signature=fh5jAMInLrX-dpFs~crHnyQ9ZDK3zADd95KGV8V4zV8prnjlP1Y-dTilSgKkx2Mi8ZVbRUexXEYZmoJjvPvlrGsN5s12brO~j6CdF4FeowmD861BwRtF6aImA6~Zdc7TnHQofhk-A9F1Bw4XfzdOxaqJVkVCd4nQbrYL1sE1emr17Z6zdU4FDC~10xwGuG44rUCyzooA9jVphfKRza1KywYNQDz4ZCbsgHpHVNnsl4Qbs4AcQkERjxfPPteRFFxY2wQPnFhiLsNJv6Z7bQfw3qAd-nN035Ab2UXqYygESdSNjpsjyDnbUVGa9NlotW3rumwdL55aAGNyb6WtVzs4bQ__&Key-Pair-Id=APKAITJV77WS5ZT7262A 2x" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-c.udemycdn.com/course/240x135/2887266_c696_5.jpg?Expires=1622691212&Signature=SinxvbC21jVtg2XaGj9WbhdTOuoujT5kszYucsLr8W3OjKgZfFEoLLLFk3CCiSZID2z2FUyVwuV4iXu76v09Kdun-AXqB595wCYEoVQe7FKRRzF7upMT9jnbFKeayod82jMf1pZYKAO8Zq4tr3NTMt8W-bVarkGoCtlJISAFtBMIUBLkhIBwsmWQBbaiHhjUWTOSNVvHxhc2kdyVn229GUNm48NTV1~hOhEIquUgBms5RlkDO5T67kZ9fEmZgatiiKBTIy-9n23xuDnLHpXkkx8wjIfBTmekFC-wNTA~4vFjJLhXAoPFE5UejdBz8FxzWucobZn8b7l9VLagyEPsdQ__&Key-Pair-Id=APKAITJV77WS5ZT7262A" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="mb-5 row">
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="mb-5 row">
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="https://img-c.udemycdn.com/course/240x135/3520172_30b8_2.jpg?Expires=1622646918&Signature=dFvaO08YG6IlcXmXGopnII870JnY7J2ikDPWwt5acS-KsmVHSMHcgmTH8yxdSBqa5hR6dyQ3OfXn1QC0XOAFwPh~tFe440d7T~ppgYBpPaA8ZYucdMODx0nZKgwji6BX3TPecjyEgmsdrbeo0r-mcokSicuT5TQtaSG6FB0WnJ7bIR5DRD77wLrhq-3AJpLEE53UvJjEkr5-wbu7POysPLeRD~L3td75W6EqUc5FJvJrLzAo3vrYe5lnNKmam8YgMhgjnmCdHyDy3YbnfP1BCEf7uGMXbZsh8w-C1p0-d4XMurCzio8BWOtqW2LL8S1JcNVc5nUQVcYlEMSXnS31Mg__&Key-Pair-Id=APKAITJV77WS5ZT7262A" alt="Card image cap">
                                    <div class="card-body">
                                      <h6 style="font-size: .9em; font-weight: bold;">MERN Stack ECommerce App - React,Redux,Node,Express,Mongo DB</h6>
                                      <small>Academia By Dr Allen Grey</small>
                                      <div><span class="checked rating-value">4.8 </span><span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star checked"></span>
                                        <span class="ratings fa fa-star"></span>
                                        <span class="ratings fa fa-star"></span></div>
                                        <div class="price">
                                            <span>$12.99 <span class="old-price">$99.78</span></span>
                                        </div>
                                        <div class="mt-1 rated">
                                            <span>Highest Rated</span>
                                        </div>
                                        <div class="mt-3 button-style">
                                            <a :href="'/learner/courses/'+item.title" style="background-color: #495057; color: white;" class="float-left btn-style btn btn-s">View</a>
                                            <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" style="background-color: #495057; color: white;" class="float-right btn-style btn btn-s">Take Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel controls -->
                <a class="carousel-control-prev" :href="'#myCarousel'+index" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" :href="'#myCarousel'+index" data-slide="next">
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
            ]
        }
    }
})
