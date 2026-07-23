document.addEventListener('DOMContentLoaded', function() {
    function TaskViewModel() {
        const self = this;

        self.keyword = ko.observable('');
        self.tasks = ko.observableArray([]);

        self.searchTasks = function() {
            const url = '/tasks/search?keyword=' + encodeURIComponent(self.keyword());

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    return response.json();
                })
                .then(data => {
                    self.tasks(data);
                })
                .catch(error => {
                    console.error('Error fetching tasks:', error);
                });
        };

        self.keyword.subscribe(function(newKeyword) {
            self.searchTasks();
        });
        self.searchTasks();
    }
    ko.applyBindings(new TaskViewModel());
});
