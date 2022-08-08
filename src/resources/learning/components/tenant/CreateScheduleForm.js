Vue.component("schedule-form", {
    props: {
        scheduleItems: {
            default: () => [],
        },
    },
    template: `
        <div class="container">
            <form class="form" @submit.prevent="validateBeforeSubmit">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="name"> Name * </label>
                        <p class="control has-icon has-icon-right">
                            <input name="name" class="form-control" v-model="form.name" v-validate="'required'" :class="{'input': true, 'border border-danger': errors.has('name') }" type="text" placeholder="Give this schedule a name">
                            <i v-show="errors.has('name')" class="fa fa-warning text-danger"></i>
                            <span v-show="errors.has('name')" class="help text-danger">@{{ errors . first('name') }}</span>
                        </p>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="capacity"> Capacity * </label>
                        <p class="control has-icon has-icon-right">
                            <input name="capacity" class="form-control" v-model="form.capacity" v-validate="'required'" :class="{'input': true, 'border border-danger': errors.has('capacity') }" type="number" placeholder="Enter capacity" min="1">
                            <i v-show="errors.has('capacity')" class="fa fa-warning text-danger"></i>
                            <span v-show="errors.has('capacity')" class="help text-danger">@{{ errors . first('capacity') }}</span>
                        </p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="description"> Description * </label>
                        <editor style="" v-validate="'required'" name="description" :class="{'input': true, 'border border-danger': errors.has('Description') }" v-model="form.description" theme="snow"></editor>
                        <i v-show="errors.has('description')" class="fa fa-warning text-danger"></i>
                        <span v-show="errors.has('description')" class="help text-danger">@{{ errors . first('description') }}</span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="short_description"> Short Description * </label>
                        <editor style="" v-validate="'required'" name="short_description" :class="{'input': true, 'border border-danger': errors.has('short_description') }" v-model="form.short_description" theme="snow"></editor>
                        <i v-show="errors.has('short_description')" class="fa fa-warning text-danger"></i>
                        <span v-show="errors.has('short_description')" class="help text-danger">@{{ errors . first('short_description') }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label> Is It For Free? </label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="is_free_yes" v-model="form.is_free" value="yes" name="is_free" class="custom-control-input">
                                <label class="custom-control-label" for="is_free_yes">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="is_free_no" v-model="form.is_free" value="no" name="is_free" class="custom-control-input">
                                <label class="custom-control-label" for="is_free_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6" v-if="form.is_free === 'no'">
                        <label for="price"> Price * </label>
                        <p class="control has-icon has-icon-right">
                            <input name="price" class="form-control" v-model="form.price" v-validate="'required'" :class="{'input': true, 'border border-danger': errors.has('price') }" type="number" placeholder="Enter price" min="0">
                            <i v-show="errors.has('price')" class="fa fa-warning text-danger"></i>
                            <span v-show="errors.has('price')" class="help text-danger">@{{ errors . first('price') }}</span>
                        </p>
                    </div>
                    <div class="form-group col-lg-6">
                        <label> Auto Confirm </label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="auto_confirm_yes" v-model="form.auto_confirm" value="yes" name="auto_confirm" class="custom-control-input">
                                <label class="custom-control-label" for="auto_confirm_yes">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="auto_confirm_no" v-model="form.auto_confirm" value="no" name="auto_confirm" class="custom-control-input">
                                <label class="custom-control-label" for="auto_confirm_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="schedule_type">Schedule Type *</label>
                        <select name="schedule_type" v-model="form.schedule_type" v-validate="'required'"
                        :class="{'input': true, 'border border-danger': errors.has('schedule_type') }" class="form-control" id="">
                            <option value="online">Online event</option>
                            <option value="offline">Offline event</option>
                            <option value="equipment">Equipment use</option>
                            <option value="workspace">Workspace</option>
                        </select>
                        <i v-show="errors.has('schedule_type')" class="fa fa-warning text-danger"></i>
                        <span v-show="errors.has('schedule_type')" class="help text-danger">@{{ errors . first('schedule_type') }}</span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="schedule_frequency">Schedule Frequency *</label>
                        <select name="schedule_frequency" v-model="form.schedule_frequency" v-validate="'required'" :class="{'input': true, 'border border-danger': errors.has('schedule_frequency') }" class="form-control" id="">
                            <option value="day_single">Single day</option>
                        </select>
                        <i v-show="errors.has('schedule_frequency')" class="fa fa-warning text-danger"></i>
                        <span v-show="errors.has('schedule_frequency')" class="help text-danger">@{{ errors . first('schedule_frequency') }}</span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="seats_per_frequency"> Available seats per frequency * </label>
                        <p class="control has-icon has-icon-right">
                            <input name="seats_per_frequency" class="form-control" v-model="form.seats_per_frequency" v-validate="'required'" :class="{'input': true, 'border border-danger': errors.has('seats_per_frequency') }" type="number" placeholder="Enter seats_per_frequency" min="1">
                            <i v-show="errors.has('seats_per_frequency')" class="fa fa-warning text-danger"></i>
                            <span v-show="errors.has('seats_per_frequency')" class="help text-danger">@{{ errors . first('seats_per_frequency') }}</span>
                        </p>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="schedule_access_type">Who can access this schedule? *</label>
                        <select name="schedule_access_type" v-model="form.schedule_access_type" v-validate="'required'" :class="{'input': true, 'border border-danger': errors.has('schedule_access_type') }" class="form-control" id="">
                            <option value="guest">Guest</option>
                            <option value="learner">Learner</option>
                        </select>
                        <i v-show="errors.has('schedule_access_type')" class="fa fa-warning text-danger"></i>
                        <span v-show="errors.has('schedule_access_type')" class="help text-danger">@{{ errors . first('schedule_access_type') }}</span>
                    </div>
                </div>
                <div class=" submit-btn d-flex justify-content-between align-items-center">
                    <span class="muted text-danger font-weight-bold"> Fields with * are required </span>
                    <button type="submit" class="btn btn-outline-secondary">Create Schedule</button>
                </div>
            </form>
        </div>
      `,
    data() {
        return {
            form: {
                name: '',
                short_description: '',
                description: '',
                price: 0,
                capacity: '',
                is_free: '',
                auto_confirm: '',
                schedule_type: '',
                schedule_frequency: '',
                schedule_access_type: '',
                seats_per_frequency: '',
            },
        };
    },
    mounted() {
        // console.log(this.scheduleItems)
    },
    methods: {
        validateBeforeSubmit(ev) {
            console.log(ev)
            this.$validator.validateAll().then((result) => {
                if (result) {
                    let loader = Vue.$loading.show()
                    axios.post(`/tenant/schedule/create`, this.form).then(res => {
                        ev.target.reset()
                        // console.log(res.data.schedule)
                        this.$emit('update-schedule-items',res.data.schedule)
                        loader.hide();
                        toastr["success"](res.data.message)
                    }).catch(e => {
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
                }
            });
        },
    },
    computed: {},
    destroyed: function () {
    },
});
  