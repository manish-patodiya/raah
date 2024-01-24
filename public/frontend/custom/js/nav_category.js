$(document).ready(function () {
  $(".cat-menu a").on("click", function (e) {
    if ($(this).next("ul").length) {
      $(this).next("ul").toggle();

      const vh = Math.max(
        document.documentElement.clientHeight || 0,
        window.innerHeight || 0
      );
      const h = vh - 200;
      $(this).next("ul").css({ height: h, "overflow-y": "scroll" });
      e.stopPropagation();
      e.preventDefault();
    }
  });

  $(document).mouseup(function (e) {
    var container = $(".category-container");
    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      $(".category-container").find("ul.cat-sub-menu").hide();
    }
  });
});
