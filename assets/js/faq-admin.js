/**
 * Genrolla — FAQ meta box repeater (admin)
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var rows = document.getElementById('genrolla-faq-rows');
        var addBtn = document.getElementById('genrolla-faq-add');
        var tpl = document.getElementById('genrolla-faq-tpl');
        if (!rows || !addBtn || !tpl) {
            return;
        }

        addBtn.addEventListener('click', function () {
            var index = rows.querySelectorAll('.genrolla-faq-row').length;
            var html = tpl.innerHTML
                .replace(/__INDEX__/g, index)
                .replace(/__NUM__/g, index + 1);

            var temp = document.createElement('div');
            temp.innerHTML = html.trim();
            var row = temp.firstElementChild;
            rows.appendChild(row);

            var input = row.querySelector('input[type="text"]');
            if (input) {
                input.focus();
            }
        });

        rows.addEventListener('click', function (e) {
            if (!e.target.classList.contains('genrolla-faq-remove')) {
                return;
            }
            e.preventDefault();
            var row = e.target.closest('.genrolla-faq-row');
            if (row) {
                row.parentNode.removeChild(row);
                renumber();
            }
        });

        function renumber() {
            var all = rows.querySelectorAll('.genrolla-faq-row');
            Array.prototype.forEach.call(all, function (row, i) {
                var num = row.querySelector('.row-num');
                if (num) {
                    num.textContent = '#' + (i + 1);
                }
                // Keep field names sequential so PHP receives a clean array.
                var q = row.querySelector('input[type="text"]');
                var a = row.querySelector('textarea');
                if (q) { q.name = 'genrolla_faq[' + i + '][q]'; }
                if (a) { a.name = 'genrolla_faq[' + i + '][a]'; }
            });
        }
    });
})();
