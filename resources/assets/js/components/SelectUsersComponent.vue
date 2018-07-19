<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <form>
                        <div v-for="(user, index) in users">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="selected_users" :value="user.id" :id="'user__' + index">
                                <label class="form-check-label" :for="'user__' + index">
                                    {{ user.name }}
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['users'],
        data() {
            return {
                selected_users: []
            };
        },
        created() {
            Event.listen('modal-saved', () => {
                Event.fire('survey-users-added', this.selected_users);
            });

            Event.listen('edit-survey', (data) => {
                console.log(data)
                this.selected_users = data;
            })
        },
        methods: {
            
        }
    }
</script>
