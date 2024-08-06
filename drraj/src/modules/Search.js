import $ from 'jquery';

class Search {
  // 1. describe and create our object
  constructor() {
    this.addSearchBox();
    this.resultsDiv = $('.search-overlay__results');
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
  }
  // 2. events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }

  // 3. methods (function... action)
  typingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);

      if(this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html('');
        this.isSpinnerVisible = false;
      }
    }
    
    this.previousValue = this.searchField.val();
  }

  getResults() {
    $.getJSON(rajData.root_url + '/wp-json/drraj/v1/search?term=' + this.searchField.val(), (results) => {
      this.resultsDiv.html(`
        <div class="row">
          <div class="one-third">
            <h2 class="search-overlay__section-title">General Info</h2>
            ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No results match your search :(</p>'}
              ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.type == "post" ? `by ${item.authorName}` : ""}</li>`).join('')}
            ${results.generalInfo.length ? '</ul>' : ''}
          </div>
          <div class="one-third">
            <h2 class="search-overlay__section-title">Events</h2>
            ${results.events.length ? '<ul class="link-list min-list">' : `<p>No event results. <a href="${rajData.root_url}/events">View all Events</a></p>`}
              ${results.events.map(item => `

              <div class="event-summary">
                <a class="event-summary__date t-center" href="${item.permalink}">
                  <span class="event-summary__month">${item.month}</span>
                  <span class="event-summary__day">${item.day}</span>
                </a>
                <div class="event-summary__content">
                  <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                  <p>${item.description}<a href="${item.permalink}" class="nu gray">Learn more</a></p>
                </div>
              </div>
          
              `).join('')}
            ${results.events.length ? '</ul>' : ''}
          </div>
          <div class="one-third">
            <h2 class="search-overlay__section-title">Rubrics</h2>
            ${results.rubrics.length ? '<ul class="link-list min-list">' : `<p>No rubric results. <a href="${rajData.root_url}/rubric">View all Rubrics</a></p>`}
              ${results.rubrics.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
            ${results.rubrics.length ? '</ul>' : ''}
            <h2 class="search-overlay__section-title">News</h2>
            ${results.news.length ? '<ul class="link-list min-list">' : `<p>No news results. <a href="${rajData.root_url}/news>View all News</a></p>`}
              ${results.news.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
            ${results.news.length ? '</ul>' : ''}
          </div>
      `);
      this.isSpinnerVisible = false;
    });
  }

  keyPressDispatcher(e) {
    if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
      this.openOverlay();
    }
    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchField.val('');
    setTimeout(() => this.searchField.focus(), 301)
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active")
    $("body").removeClass("body-no-scroll")
    this.isOverlayOpen = false;
  }

  addSearchBox() {
    $("body").append(`
    <div class="search-overlay">
      <div class="search-overlay__top">
        <div class="container">
          <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
          <input type="text" class="search-term" placeholder="Search my entire site" id="search-term">
          <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
        </div>
        <div class="container">
          <div class="search-overlay__results">
          </div>
        </div>
      </div>
    </div>
    `)
  }

}

export default Search
