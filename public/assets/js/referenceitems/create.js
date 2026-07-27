document.addEventListener('DOMContentLoaded', function () {

  function ReferenceItemViewModel() {
    const self = this;

    self.keyword = ko.observable('');
    self.searchResults = ko.observableArray([]);
    self.selectedTags = ko.observableArray([]);


    self.loadTags = function () {
      fetch('/tags')
        .then(function (response) {
          return response.json();
        })
        .then(function (tags) {
          const filteredTags = tags.filter(function (tag) {
            return !self.selectedTags().some(function (selectedTag) {
              return selectedTag.id === tag.id;
            });
          });
          self.searchResults(filteredTags);
        })
        .catch(function (error) {
          console.error('Error fetching tags:', error);
        });
    };

    self.searchTags = function () {
      const keyword = self.keyword().trim();
      if (keyword === '') {
        self.loadTags();
        return;
      }

      const url = '/tags?keyword=' + encodeURIComponent(keyword);
      fetch(url)
        .then(function (response) {
          return response.json();
        })
        .then(function (results) {
          const filteredResults = results.filter(function (tag) {
            return !self.selectedTags().some(function (selectedTag) {
              return selectedTag.id === tag.id;
            });
          });
          self.searchResults(filteredResults);
        })
        .catch(function (error) {
          console.error('Error searching tags:', error);
        });
    };

    self.keyword.subscribe(function () {
      self.searchTags();
    });


    self.selectTag = function (tag) {
      self.selectedTags.push(tag);
      self.searchTags();
    };

    self.removeTag = function (tag) {
      self.selectedTags.remove(tag);
      self.searchTags();
    };

    self.loadTags();


    // create tag

    self.createTag = function () {
      const newTagName = self.keyword().trim();

      if (newTagName === '') {
        alert('Tag name cannot be empty.');
        return;
      }

      const csrfToken = document.querySelector('input[name="fuel_csrf_token"]');

      const formData = new FormData();
      formData.append('tag_name', newTagName);
      formData.append('fuel_csrf_token', csrfToken ? csrfToken.value : '');

      fetch('/tags/create', {
        method: 'POST',
        body: formData
      })
        .then(function (response) {
          return response.json().then(function (data) {
            if (!response.ok) {
              throw new Error(data.error || 'Failed to create tag');
            }
            return data;
          });
        })
        .then(function (createdTag) {
          self.selectedTags.push({
            id: createdTag.id,
            name: createdTag.name
          });
          self.keyword('');

          document
            .querySelectorAll('input[name="fuel_csrf_token"]')
            .forEach(function (input) { 
              input.value = createdTag.csrf_token;
            });
        })
        .catch(function (error) {
          console.error('Error creating tag:', error);
          alert('Error creating tag: ' + error.message);
        });
    };
  }

  ko.applyBindings(new ReferenceItemViewModel());
});
