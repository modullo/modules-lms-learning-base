Vue.component('nav-bar', {
  props: {
    courseData: {
        type: Object,
        default: () => {},
    },
  },
  template: `
    <div>
    <div class="navbar-container d-none d-lg-block">
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand href="#">
        <span class="logo-styles">
          L
        </span>
      </b-navbar-brand>
  
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
  
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item href="#" class="title-color">{{courseData.title}}</b-nav-item>    
        </b-navbar-nav>
    
          <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <div class="progress-circle over50 p70">
            <span>70%</span>
            <div class="left-half-clipper">
              <div class="first50-bar"></div>
              <div class="value-bar"></div>
            </div>
          </div>
          <b-nav-item-dropdown text="Your Progress" right>
            <b-dropdown-item href="#">
              4 of 5 Completed
            </b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
    <div class="d-lg-none">
      <b-navbar class="p-3" type="dark" variant="dark">
      <b-icon icon="arrow-left" class="text-white font-weight-bold"></b-icon>
      <span class="text-white text-left pl-3" style="font-size: .9em;">
      {{courseData.title}}
      </span>
      </b-navbar>
    </div>
    </div>
  `,
})