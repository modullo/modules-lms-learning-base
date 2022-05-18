Vue.component("lesson-tabs", {
    props: {
      courseData: {
        default: () => [],
      },
    },
    template: `
      <div class="m-4 ml-5">
      <b-tabs active-nav-item-class="font-weight-bold text-uppercase" content-class="mt-3">
          <div v-if="mobileDisplay">
          <b-tab title="Course Content" :title-link-class="linkClass()" active>
              <sidebar-item :course-data="courseData" :currentPlayingVideo="listener" @send-video-to-sidebar="collectVideoFromSideBar"></sidebar-item>
          </b-tab>
          </div>
  
          <b-tab title="Overview" style="margin-bottom: 10em;" :title-link-class="linkClass()">
          <b-container>
           <b-row>
              <b-col lg="8" offset-lg="2">
                  <h3 class="text-left">About This Lesson</h3>
                  <div style="font-size:1.1em" class="overview-text" v-html="tabsData.description">
                  Become a Fullstack Laravel Engineer by 
                  developing a Dribbble Clone, Provisioning a server and Deploying with SSL
                  </div>
                  <hr>
                  
              </b-col>
           </b-row>
          </b-container>
          </b-tab>
          <b-tab title="Notes" :title-link-class="linkClass()">
          <b-container class="mb-5">
          <b-form @submit.prevent="saveNote">
              <b-row>
                  <b-col>
                  <b-col lg="8" offset-lg="2">
                      <h3 class="text-left">Notes</h3>
                      <div class="mb-5">
                          <b-form-select v-model="selected" :options="computeModuleOptions"></b-form-select>
                      </div>
                          <div class="mb-5 form-row">
                              <div class="form-group col-lg-12">
                                  <label for="description"> Take Note </label>
                                  <editor v-model="note" style="height: 100px; width: 100%" theme="snow"></editor>
                              </div>
                          </div>
                          <b-button type="submit" v-if="selected" class="mt-3 btn-block btn btn-outline-secondary">Submit</b-button>
                  </b-col> 
                  </b-col>
              </b-row>
          </b-form>
          </b-container>
          </b-tab>
      </b-tabs>
      </div>
      `,
    data() {
      return {
        tabsData: null,
        listener: {},
        note: '',
        view: "display:none",
        selected: null,
        options: [
          { value: null, text: "Select Module For Note" },
          { value: "a", text: "Module 1" },
          { value: "b", text: "Module 2" },
          { value: "c", text: "Module 3" },
          { value: "d", text: "Module 4" },
          { value: "e", text: "Module 5" },
        ],
        mobileDisplay: false,
      };
    },
    computed: {
      computeModuleOptions() {
        const modulesOptions = this.courseData.modules.map((module) => {
          return {
            value: module.id,
            text: module.title,
          };
        });
        modulesOptions.unshift({ value: null, text: "Select Module For Note" });
        return modulesOptions;
      },
    },
    destroyed: function () {
      document.removeEventListener("resize", this.resizeForMobile);
    },
    mounted() {
      this.resizeForMobile();
      window.addEventListener("resize", this.resizeForMobile);
    },
    methods: {
      saveNote() {
          let loader = Vue.$loading.show();
          axios
          .post(`/learner/notes/${this.selected}`, {note: this.note})
          .then((res) => {
              loader.hide();
              this.note = ''
              toastr["success"](res.data.message)
              return
          })
          .catch(() => {
              loader.hide();
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
      linkClass() {
        return "fix-tab";
      },
      collectVideoFromSideBar(payload) {
        this.$emit("send-video-to-appwrapper", payload);
      },
      resizeForMobile() {
        if (window.innerWidth < 991) {
          this.mobileDisplay = true;
        } else {
          this.mobileDisplay = false;
        }
      },
    },
  });
  