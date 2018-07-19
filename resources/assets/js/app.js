
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Make global bus event
window.Event = new class {
	constructor() {
		this.vue = new Vue();
	}

	fire(event, data = null) {
		this.vue.$emit(event, data);
	}

	listen(event, callback) {
		this.vue.$on(event, callback);
	}
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('select-users-component', require('./components/SelectUsersComponent.vue'));

Vue.component('modal-component', require('./components/ModalComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
    	survey: {}
    },
    created() {
    	Event.listen('survey-users-added', (data) => {
    		this.survey.users = data;
    	})

        if (isNaN(this.survey.users) && !isNaN(this.$refs.selectedUsers)) {
            this.survey.users = JSON.parse(this.$refs.selectedUsers.value);
            Event.fire('edit-survey', this.survey.users)
        }
    },
    methods: {
        confirm() {
            let result = confirm('Are you sure?');
            return result;
        },
    	submitSurveyForm() {
    		axios.post('/surveys', this.survey).then((res) => {
    			console.log(res);
    			location.reload();
    		});
    	},
        submitEditSurveyForm() {
            if (isNaN(this.survey.name)) {
                this.survey.name = this.$refs.surveyName.value;
            }

            console.log(this.survey.users);

            axios.put('/surveys/' + this.$refs.surveyId.value, this.survey).then((res) => {
                console.log(res);
                window.location = '/surveys';
            });
        }
    }
});
