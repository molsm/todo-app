var app = new Vue({
    el: '#app',
    delimiters: ['${', '}'],

    data: {
        newName: '',
        names: ['Joe', 'Mary', 'Jane', 'Jack']
    },

    methods: {
        addName: function () {
            this.names.push(this.newName);
            this.newName = '';
        }
    }
});