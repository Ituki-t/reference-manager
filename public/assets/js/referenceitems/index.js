document.addEventListener('DOMContentLoaded', function() {
  function ReferenceItemViewModel(taskID) {
    const self = this;

    self.keyword = ko.observable('');
    self.referenceItems = ko.observableArray([]);

    self.searchReferenceItems = function() {
      const url = '/referenceitems/search/' +
        taskID +
        '?keyword=' +
        encodeURIComponent(self.keyword());

      fetch(url)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }

          return response.json();
        })
        .then(data => {
          self.referenceItems(data);
        })
        .catch(error => {
          console.error('Error fetching referenceItems:', error);
        });
    };

    self.keyword.subscribe(function(newKeyword) {
      self.searchReferenceItems();
    });
    self.searchReferenceItems();
  }

  const taskID = document.getElementById('taskID').value;

  ko.applyBindings(new ReferenceItemViewModel(taskID));
});
