(function () {
  var header = document.querySelector(".site-header");
  var toggle = document.querySelector(".menu-toggle");
  if (header && toggle) {
    toggle.addEventListener("click", function () {
      var open = header.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
  }

  document.querySelectorAll('a[href^="#"]').forEach(function (a) {
    a.addEventListener("click", function (e) {
      var id = a.getAttribute("href");
      if (!id || id === "#") return;
      var el = document.querySelector(id);
      if (!el) return;
      e.preventDefault();
      var off = header ? header.offsetHeight + 8 : 8;
      window.scrollTo({
        top: el.getBoundingClientRect().top + window.scrollY - off,
        behavior: "smooth",
      });
    });
  });

  function normalize(s) {
    return (s || "")
      .toLowerCase()
      .replace(/[₹|,._\-]+/g, " ")
      .replace(/\s+/g, " ")
      .trim();
  }

  function appHaystack(card) {
    if (card._ygHay) return card._ygHay;
    var title = (card.querySelector(".yg-app__title") || {}).textContent || "";
    var bonus = (card.querySelector(".yg-app__bonus") || {}).textContent || "";
    var alt = "";
    var img = card.querySelector("img");
    if (img) alt = img.getAttribute("alt") || "";
    var href = card.getAttribute("href") || "";
    var slug = href.replace(/\/+$/, "").split("/").pop() || "";
    card._ygHay = normalize([title, bonus, alt, slug.replace(/-/g, " ")].join(" "));
    return card._ygHay;
  }

  function ensureEmptyNote(list) {
    var note = list.querySelector(".yg-search-empty");
    if (!note) {
      note = document.createElement("p");
      note.className = "yg-search-empty";
      note.hidden = true;
      list.appendChild(note);
    }
    return note;
  }

  function isHindi() {
    return (
      document.documentElement.lang === "hi" ||
      /\/hi\/?$/.test(location.pathname) ||
      /-hindi/.test(location.pathname)
    );
  }

  function hasAppList() {
    return !!document.querySelector("#list .yg-app, .yg-apps > .yg-app");
  }

  function homePath() {
    return isHindi() ? "/hi/" : "/";
  }

  function filterApps(query) {
    var q = normalize(query);
    var lists = document.querySelectorAll("#list .yg-apps");
    if (!lists.length) lists = document.querySelectorAll(".yg-apps:not(.yg-apps--rated)");

    var totalVisible = 0;
    lists.forEach(function (list) {
      var cards = list.querySelectorAll(":scope > .yg-app");
      if (!cards.length) return;
      var visible = 0;
      cards.forEach(function (card) {
        var show = !q || appHaystack(card).indexOf(q) !== -1;
        card.style.display = show ? "" : "none";
        card.classList.toggle("is-search-hidden", !show);
        if (show) visible += 1;
      });
      totalVisible += visible;
      var note = ensureEmptyNote(list);
      if (q && visible === 0) {
        note.hidden = false;
        note.textContent = isHindi()
          ? "कोई ऐप नहीं मिला: “" + query + "”"
          : 'No apps found for “' + query + '”';
      } else {
        note.hidden = true;
      }
    });

    document.querySelectorAll(".yg-apps--rated > .yg-app").forEach(function (card) {
      var show = !q || appHaystack(card).indexOf(q) !== -1;
      card.style.display = show ? "" : "none";
    });

    return totalVisible;
  }

  function scrollToList() {
    var el = document.querySelector("#list") || document.querySelector(".yg-apps");
    if (!el) return;
    var off = header ? header.offsetHeight + 10 : 10;
    window.scrollTo({
      top: el.getBoundingClientRect().top + window.scrollY - off,
      behavior: "smooth",
    });
  }

  function clearOtherInput(currentInput) {
    document
      .querySelectorAll(
        "form.yg-hsearch input[type='search'], form.yg-search input[type='search']"
      )
      .forEach(function (input) {
        if (input !== currentInput) input.value = "";
      });
  }

  function runSearch(query, opts) {
    opts = opts || {};
    var q = (query || "").trim();

    if (!hasAppList()) {
      location.href = q ? homePath() + "?q=" + encodeURIComponent(q) + "#list" : homePath();
      return;
    }

    filterApps(q);
    if (opts.scroll !== false) scrollToList();

    try {
      var url = new URL(location.href);
      if (q) url.searchParams.set("q", q);
      else url.searchParams.delete("q");
      url.searchParams.delete("s");
      history.replaceState(null, "", url.pathname + url.search + (q ? "#list" : ""));
    } catch (e) {}
  }

  function bindForm(form) {
    if (!form) return;
    var input = form.querySelector("input[type='search'], input[name='q'], input[name='s']");
    if (!input) return;
    if (input.name === "s") input.name = "q";

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      clearOtherInput(input);
      runSearch(input.value, { scroll: true });
    });

    var timer = null;
    input.addEventListener("input", function () {
      // Keep the other search box empty — both stay separate
      clearOtherInput(input);
      clearTimeout(timer);
      timer = setTimeout(function () {
        if (!hasAppList()) return;
        filterApps(input.value);
      }, 100);
    });

    input.addEventListener("focus", function () {
      // Focusing one search clears the other so they never look linked
      clearOtherInput(input);
    });
  }

  document.querySelectorAll("form.yg-hsearch, form.yg-search").forEach(bindForm);

  // URL ?q= only fills the hero search on home (or header if hero missing)
  try {
    var params = new URLSearchParams(location.search);
    var initial = params.get("q") || "";
    if (initial && hasAppList()) {
      var hero = document.querySelector("form.yg-search input[type='search']");
      var head = document.querySelector("form.yg-hsearch input[type='search']");
      var target = hero || head;
      if (target) {
        target.value = initial;
        if (hero && head) head.value = "";
      }
      filterApps(initial);
      setTimeout(scrollToList, 80);
    }
  } catch (e) {}
})();
