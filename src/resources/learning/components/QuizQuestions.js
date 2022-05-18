Vue.component('quiz-questions', {
    props: {
        // questions: {
        //     type: Array,
        //     required: true
        // }
    },
    template: 
    `
    <div>
    <b-modal hide-footer hide-header-close no-close-on-backdrop no-close-on-esc id="modal-lg" size="xl" title="Module 1 Quiz">
        <h6>Graded Quiz : 30mins | Total Points 6</h6>
        <h3 class="mt-3">Questions</h3>
        <b-form>
            <ol class="mt-2">
                <li>Question 1
                This week, Professor Santos showed visual illusions to make a point
                about how humans think. The illusion below, the Ponzo Illusion, was left out.
                <b-list-group>
                <b-list-group-item>
                    <b-form-group label="Select One Option" v-slot="{ ariaDescribedby }">
                    <b-form-radio-group
                        v-model="selected"
                        :options="options"
                        :aria-describedby="ariaDescribedby"
                        name="plain-stacked"
                        plain
                        stacked
                    ></b-form-radio-group>
                    </b-form-group>
                </b-list-group-item>
                </b-list-group>
                </li>

                <li class="mt-3">Question 2
                This week, Professor Santos showed visual illusions to make a point
                about how humans think. The illusion below, the Ponzo Illusion, was left out.
                <b-list-group>
                <b-list-group-item>
                    <b-form-group label="Select One Option" v-slot="{ ariaDescribedby }">
                    <b-form-radio-group
                    v-model="selected1"
                    :options="options"
                    :aria-describedby="ariaDescribedby"
                    name="plain-stacked2"
                    plain
                    stacked
                ></b-form-radio-group>
                    </b-form-group>
                </b-list-group-item>
                </b-list-group>
                </li>

                <li class="mt-3">Question 3
                This week, Professor Santos showed visual illusions to make a point
                about how humans think. The illusion below, the Ponzo Illusion, was left out.
                <b-list-group>
                <b-list-group-item>
                    <b-form-group label="Select One Option" v-slot="{ ariaDescribedby }">
                    <b-form-radio-group
                    v-model="selected2"
                    :options="options"
                    :aria-describedby="ariaDescribedby"
                    name="plain-stacked3"
                    plain
                    stacked
                ></b-form-radio-group>
                    </b-form-group>
                </b-list-group-item>
                </b-list-group>
                </li>
            </ol>
            <hr>
            <div class="float-right">
            <b-button @click="$bvModal.hide('modal-lg')" v-b-modal.modal-footer-sm>cancel</b-button>
            <b-button  v-b-modal.modal-footer-lg>submit</b-button>
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
        }
    }
})