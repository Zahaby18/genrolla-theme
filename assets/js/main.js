/**
 * Genrolla theme JS — menu, search drawer, ToC
 */
(function () {
    'use strict';

    /* ---------- Mobile menu ---------- */
    var menuToggle = document.getElementById('genrolla-menu-toggle');
    var nav = document.querySelector('.main-nav');
    if (menuToggle && nav) {
        menuToggle.addEventListener('click', function () {
            nav.classList.toggle('open');
        });
    }

    /* ---------- Search drawer ---------- */
    var searchToggle = document.getElementById('genrolla-search-toggle');
    var searchDrawer = document.getElementById('genrolla-search-drawer');
    if (searchToggle && searchDrawer) {
        searchToggle.addEventListener('click', function () {
            searchDrawer.classList.toggle('open');
            var input = searchDrawer.querySelector('input[type="search"]');
            if (searchDrawer.classList.contains('open') && input) {
                setTimeout(function () { input.focus(); }, 100);
            }
        });
        document.addEventListener('click', function (e) {
            if (searchDrawer.classList.contains('open') && !searchDrawer.contains(e.target) && e.target !== searchToggle && !searchToggle.contains(e.target)) {
                searchDrawer.classList.remove('open');
            }
        });
    }

    /* ---------- Table of Contents (from h2 in post body) ---------- */
    var body = document.getElementById('genrolla-post-body');
    if (body) {
        var h2s = body.querySelectorAll('h2');
        if (h2s.length >= 2) {
            // Build TOC container
            var tocWrap = document.createElement('div');
            tocWrap.className = 'toc';
            var tocTitle = document.createElement('div');
            tocTitle.className = 'toc-title';
            tocTitle.innerHTML = '<i class="fa-solid fa-list"></i> Daftar Isi';
            tocWrap.appendChild(tocTitle);
            var tocList = document.createElement('ol');
            tocWrap.appendChild(tocList);

            h2s.forEach(function (h2, i) {
                var id = 'genrolla-toc-' + (i + 1);
                h2.setAttribute('id', id);
                var li = document.createElement('li');
                var a = document.createElement('a');
                a.href = '#' + id;
                a.textContent = h2.textContent;
                li.appendChild(a);
                tocList.appendChild(li);
            });

            body.insertBefore(tocWrap, body.firstChild);
        }
    }

    /* ---------- Smooth scroll for anchor links ---------- */
    document.addEventListener('click', function (e) {
        var target = e.target.closest('a[href^="#"]');
        if (target) {
            var hash = target.getAttribute('href');
            if (hash.length > 1) {
                var el = document.querySelector(hash);
                if (el) {
                    e.preventDefault();
                    el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        }
    });
})();
