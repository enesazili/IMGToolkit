<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Toolkit — görsel işleme</title>
    <style>
:root {
    --bg: #fbf7ed;
    --surface: #f2ead8;
    --surface-raised: #f6efe0;
    --ink: #282828;
    --ink-soft: #46433d;
    --muted: #6b665c;
    --line: #ded5c3;
    --line-strong: #c8bca6;
    --accent: #a4481f;
    --accent-soft: #f0dccb;
    --olive: #5b6a3d;
    --focus: #8d3a16;
    --selection: #e9d3bf;
    --font-sans: "Segoe UI", system-ui, -apple-system, "Helvetica Neue", Arial, sans-serif;
    --font-serif: "Iowan Old Style", "Palatino Linotype", Palatino, "Book Antiqua", Georgia, serif;
    --font-mono: "Cascadia Mono", ui-monospace, SFMono-Regular, Consolas, "Liberation Mono", monospace;
    --container: 1160px;
    --gutter: clamp(1.25rem, 4vw, 2.5rem);
    --radius: 2px;
    --ease: cubic-bezier(.2, .6, .2, 1);
    --speed: 180ms;
    color-scheme: light;
}

@media (prefers-color-scheme: dark) {
    :root {
        --bg: #0d1117;
        --surface: #161b22;
        --surface-raised: #1b222c;
        --ink: #e6edf3;
        --ink-soft: #c9d1d9;
        --muted: #9aa4af;
        --line: #30363d;
        --line-strong: #3d444d;
        --accent: #79b8ff;
        --accent-soft: #16283c;
        --olive: #8fbf7f;
        --focus: #a5d6ff;
        --selection: #1f3a56;
        color-scheme: dark;
    }
}

*, *::before, *::after { box-sizing: border-box; }
html { -webkit-text-size-adjust: 100%; }
body {
    margin: 0;
    background: var(--bg);
    color: var(--ink);
    font-family: var(--font-sans);
    font-size: 1rem;
    line-height: 1.65;
    -webkit-font-smoothing: antialiased;
}
main { display: block; }
h1, h2, h3 { color: var(--ink); text-wrap: balance; }
p { margin-top: 0; }
a { color: var(--accent); text-decoration-thickness: 1px; text-underline-offset: .18em; }
[hidden] { display: none !important; }
::selection { background: var(--selection); color: var(--ink); }

.container {
    width: 100%;
    max-width: var(--container);
    margin-inline: auto;
    padding-inline: var(--gutter);
}

.section { padding-block: clamp(2.25rem, 5vw, 3.75rem); }

.row { display: flex; flex-wrap: wrap; margin-inline: -.75rem; }
.row > * { width: 100%; padding-inline: .75rem; }

@media (min-width: 992px) {
    .col-lg-4 { width: 33.3333%; }
    .col-lg-5 { width: 41.6667%; }
    .col-lg-7 { width: 58.3333%; }
    .col-lg-8 { width: 66.6667%; }
    .offset-lg-1 { margin-left: 8.3333%; }
}

.section__label {
    margin-bottom: 1.15rem;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .67rem;
    letter-spacing: .14em;
    line-height: 1.5;
    text-transform: uppercase;
}

.section__num { margin-right: .45rem; color: var(--accent); }

.section__title {
    margin: 0 0 1.25rem;
    font-family: var(--font-serif);
    font-size: clamp(2rem, 3.8vw, 3rem);
    font-weight: 400;
    line-height: 1.06;
    letter-spacing: -.03em;
}

.section__intro {
    max-width: 36rem;
    margin-bottom: 1.5rem;
    color: var(--ink-soft);
    font-size: .98rem;
    line-height: 1.7;
}

.visually-hidden {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    padding: 0 !important;
    margin: -1px !important;
    overflow: hidden !important;
    clip: rect(0, 0, 0, 0) !important;
    white-space: nowrap !important;
    border: 0 !important;
}

:where(a, button, [tabindex]):focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 3px;
}

@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: .01ms !important;
    }
}
/* ==========================================================================
   Tarayıcı araçları — Image Toolkit, Dev Toolbox, Text Diff, CSV, QR Studio
   Renkler site.css tokenlarından gelir; iki tema da desteklenir.
   ========================================================================== */

:root {
    --tool-add-bg: #e6efdb;
    --tool-add-ink: #2f4a1f;
    --tool-del-bg: #f7e2d8;
    --tool-del-ink: #7a2c10;
    --tool-change-bg: #f4e8c8;
    --tool-change-ink: #6b4a0f;
    --tool-warn-bg: #f6ecd2;
    --tool-warn-line: #a56a14;
}

[data-theme="dark"] {
    --tool-add-bg: #14261a;
    --tool-add-ink: #b8e6b0;
    --tool-del-bg: #2b1512;
    --tool-del-ink: #ffc2ad;
    --tool-change-bg: #2a2311;
    --tool-change-ink: #f0d491;
    --tool-warn-bg: #2a2311;
    --tool-warn-line: #d4a24a;
}

.site-nav--tool .site-nav__list {
    gap: 1.5rem;
}

.site-nav__label {
    display: inline-flex;
    align-items: center;
    min-height: 2.75rem;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .72rem;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.tool .section__intro {
    max-width: 34rem;
}

.tool [hidden] {
    display: none !important;
}

/* Bilgi blokları --------------------------------------------------------- */

.tool-notice {
    margin-top: 2rem;
    padding: 1.35rem 1.4rem;
    border: 1px solid var(--line);
    border-left: 2px solid var(--accent);
    background: var(--surface-raised);
}

.tool-notice__title {
    margin: 0 0 .75rem;
    font-family: var(--font-mono);
    font-size: .74rem;
    font-weight: 600;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--muted);
}

.tool-notice__list {
    margin: 0;
    padding-left: 1.1rem;
    color: var(--ink-soft);
    font-size: .88rem;
    line-height: 1.6;
}

.tool-notice__list li + li {
    margin-top: .3rem;
}

.tool-meta {
    margin-top: 2rem;
}

.tool-meta__title {
    margin: 0 0 .6rem;
    font-family: var(--font-mono);
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: .09em;
    text-transform: uppercase;
    color: var(--muted);
}

.tool-meta__line {
    margin: 0 0 .35rem;
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.55;
}

.tool-meta__key {
    display: inline-block;
    min-width: 7.5rem;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .72rem;
    letter-spacing: .05em;
    text-transform: uppercase;
}

.tool-notes {
    margin: 0;
    padding-left: 1.1rem;
    color: var(--muted);
    font-size: .82rem;
    line-height: 1.6;
}

.tool-notes li + li {
    margin-top: .25rem;
}

.tool-links {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem 1.75rem;
    margin-top: 1.6rem;
}

.tool-noscript {
    margin-top: 1rem;
    color: var(--muted);
    font-size: .82rem;
    line-height: 1.5;
}

/* Paneller, alanlar ve düğmeler ----------------------------------------- */

.tool-panel {
    padding: clamp(1.15rem, 3vw, 1.9rem);
    border: 1px solid var(--line);
    background: var(--surface-raised);
}

.tool-panel + .tool-panel {
    margin-top: 1.25rem;
}

.tool-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem 1.25rem;
}

.tool-grid--three {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

.tool-field {
    min-width: 0;
    margin-bottom: 1.1rem;
}

.tool-grid .tool-field {
    margin-bottom: 0;
}

.tool-label,
.tool-legend {
    display: block;
    margin-bottom: .4rem;
    font-family: var(--font-mono);
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--muted);
}

.tool-field__hint,
.tool-hint {
    margin: .45rem 0 0;
    color: var(--muted);
    font-size: .8rem;
    line-height: 1.5;
}

.tool-input,
.tool-select,
.tool-textarea {
    width: 100%;
    min-height: 2.75rem;
    padding: .55rem .7rem;
    border: 1px solid var(--line-strong);
    border-radius: var(--radius);
    background: var(--bg);
    color: var(--ink);
    font: inherit;
    font-size: .92rem;
}

.tool-textarea {
    min-height: 10rem;
    resize: vertical;
    font-family: var(--font-mono);
    font-size: .84rem;
    line-height: 1.55;
}

.tool-textarea--short {
    min-height: 6rem;
}

.tool-input:focus-visible,
.tool-select:focus-visible,
.tool-textarea:focus-visible,
.column-toggle input:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

.tool-input:disabled,
.tool-select:disabled,
.tool-textarea:disabled {
    opacity: .6;
}

.tool-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: .6rem 1rem;
}

.tool-check {
    display: inline-flex;
    align-items: center;
    gap: .55rem;
    min-height: 2.75rem;
    color: var(--ink-soft);
    font-size: .86rem;
}

.tool-check input {
    width: 1.1rem;
    height: 1.1rem;
    accent-color: var(--accent);
}

.tool-actions {
    display: flex;
    flex-wrap: wrap;
    gap: .75rem;
    margin-top: 1.3rem;
}

.button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 2.75rem;
    padding: .55rem 1.15rem;
    border: 1px solid var(--line-strong);
    border-radius: var(--radius);
    background: transparent;
    color: var(--ink);
    font: inherit;
    font-size: .86rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: background var(--speed) var(--ease), border-color var(--speed) var(--ease), color var(--speed) var(--ease);
}

.button--primary {
    border-color: var(--accent);
    background: var(--accent);
    color: var(--bg);
}

.button--quiet {
    color: var(--ink-soft);
}

.button:disabled {
    cursor: not-allowed;
    opacity: .55;
}

@media (hover: hover) {
    .button:not(:disabled):hover {
        border-color: var(--accent);
        background: var(--surface);
        color: var(--accent);
    }

    .button--primary:not(:disabled):hover {
        background: var(--ink);
        border-color: var(--ink);
        color: var(--bg);
    }
}

.button:focus-visible,
.dev-tab:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

.tool-status {
    min-height: 1.4rem;
    margin: 1rem 0 0;
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.5;
}

.tool-status.is-error {
    color: var(--accent);
}

.tool-empty {
    margin: 1rem 0 0;
    padding: 1.25rem;
    border: 1px dashed var(--line-strong);
    color: var(--muted);
    font-size: .88rem;
    line-height: 1.55;
    text-align: center;
}

.tool-warning {
    margin: 1rem 0 0;
    padding: .8rem 1rem;
    border-left: 2px solid var(--tool-warn-line);
    background: var(--tool-warn-bg);
    color: var(--ink-soft);
    font-size: .84rem;
    line-height: 1.55;
}

.tool-output {
    min-height: 7rem;
    max-height: 24rem;
    margin: 0;
    padding: .9rem 1rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
    color: var(--ink);
    font-family: var(--font-mono);
    font-size: .82rem;
    line-height: 1.55;
    white-space: pre-wrap;
    overflow-wrap: anywhere;
}

.tool-output:empty::before {
    content: "Sonuç burada görünecek.";
    color: var(--muted);
}

/* Dosya bırakma ---------------------------------------------------------- */

.dropzone {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .35rem;
    min-height: 10rem;
    padding: 1.6rem 1.25rem;
    border: 1px dashed var(--line-strong);
    border-radius: var(--radius);
    background: var(--bg);
    text-align: center;
    cursor: pointer;
    transition: border-color var(--speed) var(--ease), background var(--speed) var(--ease);
}

.dropzone:hover,
.dropzone:focus-within {
    border-color: var(--accent);
    background: var(--surface);
}

.dropzone.is-dragover {
    border-style: solid;
    border-color: var(--accent);
    background: var(--accent-soft);
}

.dropzone__icon {
    font-family: var(--font-mono);
    font-size: 1.4rem;
    color: var(--accent);
}

.dropzone__title {
    font-size: .98rem;
    font-weight: 600;
    color: var(--ink);
}

.dropzone__hint {
    max-width: 26rem;
    color: var(--muted);
    font-size: .82rem;
    line-height: 1.5;
}

.dropzone:focus-within {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

/* Image Toolkit ---------------------------------------------------------- */

.image-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    gap: 1.25rem;
}

.image-preview-wrap {
    padding: 1rem;
    border: 1px solid var(--line);
    background: var(--bg);
}

.image-preview {
    display: block;
    width: 100%;
    max-width: 34rem;
    height: auto;
    min-height: 9rem;
    margin: 0 auto;
    border: 1px solid var(--line);
    background: var(--surface);
}

.image-preview-note {
    margin: .7rem 0 0;
    color: var(--muted);
    font-size: .8rem;
    line-height: 1.45;
    text-align: center;
}

.image-list {
    margin: 1rem 0 0;
    padding: 0;
    list-style: none;
    border-top: 1px solid var(--line);
}

.image-list:empty {
    border-top: 0;
}

.image-item {
    padding: .9rem .1rem;
    border-bottom: 1px solid var(--line);
}

.image-item__main {
    display: flex;
    align-items: flex-start;
    gap: .9rem;
}

.image-item__text {
    flex: 1 1 auto;
    min-width: 0;
}

.image-thumb {
    flex: 0 0 auto;
    max-width: 104px;
    max-height: 104px;
    border: 1px solid var(--line);
    background: var(--surface);
}

.image-item__name {
    margin: 0;
    overflow-wrap: anywhere;
    font-size: .92rem;
    font-weight: 600;
}

.image-item__meta {
    margin: .25rem 0 0;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .72rem;
    line-height: 1.45;
}

.image-item__state {
    margin: .4rem 0 0;
    color: var(--ink-soft);
    font-size: .82rem;
    line-height: 1.45;
}

.image-item__state.is-error {
    color: var(--accent);
}

.image-item__actions {
    display: flex;
    flex-wrap: wrap;
    gap: .35rem;
    margin-top: .5rem;
}

.image-item__remove {
    min-height: 2.75rem;
    padding: .3rem .65rem;
    border: 1px solid transparent;
    border-radius: var(--radius);
    background: transparent;
    color: var(--muted);
    font: inherit;
    font-size: .78rem;
    cursor: pointer;
}

.image-item__remove:hover,
.image-item__remove:focus-visible {
    border-color: var(--line-strong);
    color: var(--ink);
}

.image-item__remove:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

.image-item__result {
    margin: .55rem 0 0;
}

.image-download {
    display: inline-flex;
    align-items: center;
    min-height: 2.75rem;
    color: var(--ink);
    font-size: .86rem;
    font-weight: 600;
    text-decoration: underline;
    text-decoration-color: var(--line-strong);
    text-underline-offset: .25em;
}

.image-download:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

/* Dev Toolbox ------------------------------------------------------------ */

.dev-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: .35rem;
    margin: 0 0 1.1rem;
    padding: 0;
    list-style: none;
    border-bottom: 1px solid var(--line);
}

.dev-tab {
    min-height: 2.75rem;
    padding: .5rem .85rem;
    border: 0;
    border-bottom: 2px solid transparent;
    background: transparent;
    color: var(--muted);
    font: inherit;
    font-size: .82rem;
    font-weight: 600;
    cursor: pointer;
}

.dev-tab[aria-selected="true"] {
    border-bottom-color: var(--accent);
    color: var(--ink);
}

.dev-panel {
    min-width: 0;
}

.dev-panel__title {
    margin: 0 0 .5rem;
    font-family: var(--font-serif);
    font-size: 1.3rem;
}

.dev-panel__intro {
    margin: 0 0 1rem;
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.55;
}

.dev-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
}

.dev-output-label {
    display: block;
    margin: 1rem 0 .4rem;
    font-family: var(--font-mono);
    font-size: .7rem;
    font-weight: 600;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--muted);
}

.dev-jwt-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

/* Text Diff -------------------------------------------------------------- */

.diff-layout {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
}

.diff-summary {
    margin: 1rem 0 0;
    padding: .75rem 1rem;
    border-left: 2px solid var(--accent);
    background: var(--surface);
    color: var(--ink-soft);
    font-size: .86rem;
    line-height: 1.5;
}

.diff-summary.is-error {
    color: var(--accent);
}

.diff-scroll {
    max-height: 34rem;
    margin-top: 1rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
}

.diff-table {
    width: 100%;
    border-collapse: collapse;
    font-family: var(--font-mono);
    font-size: .78rem;
    line-height: 1.5;
}

.diff-table caption {
    padding: .55rem .7rem;
    border-bottom: 1px solid var(--line);
    color: var(--muted);
    font-family: var(--font-sans);
    font-size: .78rem;
    text-align: left;
}

.diff-table th {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: .45rem .55rem;
    border-bottom: 1px solid var(--line-strong);
    background: var(--surface);
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .68rem;
    font-weight: 600;
    letter-spacing: .05em;
    text-align: left;
    text-transform: uppercase;
    white-space: nowrap;
}

.diff-table td {
    padding: .38rem .55rem;
    border-bottom: 1px solid var(--line);
    vertical-align: top;
}

.diff-table__number {
    width: 4.2rem;
    color: var(--muted);
    text-align: right;
    white-space: nowrap;
}

.diff-table__status {
    width: 3.2rem;
    font-weight: 700;
    text-align: center;
}

.diff-table__text {
    overflow-wrap: anywhere;
    white-space: pre-wrap;
}

.diff-row--insert {
    background: var(--tool-add-bg);
    color: var(--tool-add-ink);
}

.diff-row--delete {
    background: var(--tool-del-bg);
    color: var(--tool-del-ink);
}

.diff-row--change {
    background: var(--tool-change-bg);
    color: var(--tool-change-ink);
}

.diff-row--equal {
    color: var(--ink-soft);
}

.diff-line {
    display: block;
}

.diff-line--removed::before {
    content: "− ";
    font-weight: 700;
}

.diff-line--added::before {
    content: "+ ";
    font-weight: 700;
}

.diff-line--removed {
    text-decoration: line-through;
    text-decoration-thickness: 1px;
}

.diff-empty {
    padding: 1.25rem !important;
    color: var(--muted);
    text-align: center;
}

/* CSV Toolkit ------------------------------------------------------------ */

.csv-controls {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 1rem;
    margin-top: 1.1rem;
}

.csv-columns {
    display: flex;
    flex-wrap: wrap;
    gap: .2rem .9rem;
    max-height: 10rem;
    margin: .2rem 0 0;
    padding: .5rem .65rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
}

.column-toggle {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    min-height: 2.75rem;
    color: var(--ink-soft);
    font-size: .8rem;
    overflow-wrap: anywhere;
}

.column-toggle input {
    flex: 0 0 auto;
    width: 1rem;
    height: 1rem;
    accent-color: var(--accent);
}

.csv-scroll {
    max-height: 32rem;
    margin-top: 1rem;
    overflow: auto;
    border: 1px solid var(--line);
    background: var(--bg);
}

.csv-table {
    width: 100%;
    border-collapse: collapse;
    font-family: var(--font-mono);
    font-size: .76rem;
    line-height: 1.45;
}

.csv-table caption {
    padding: .55rem .7rem;
    border-bottom: 1px solid var(--line);
    color: var(--muted);
    font-family: var(--font-sans);
    font-size: .78rem;
    text-align: left;
}

.csv-table th {
    position: sticky;
    top: 0;
    z-index: 1;
    padding: .5rem .55rem;
    border-bottom: 1px solid var(--line-strong);
    background: var(--surface);
    color: var(--ink-soft);
    font-family: var(--font-mono);
    font-size: .7rem;
    font-weight: 600;
    text-align: left;
    white-space: nowrap;
}

.csv-table td {
    max-width: 24rem;
    padding: .42rem .55rem;
    border-bottom: 1px solid var(--line);
    overflow-wrap: anywhere;
    vertical-align: top;
    white-space: pre-wrap;
}

.csv-table__line {
    width: 7rem;
    color: var(--muted);
    white-space: nowrap;
}

.csv-row.is-duplicate {
    background: var(--tool-change-bg);
    color: var(--tool-change-ink);
}

.csv-duplicate-badge {
    display: inline-block;
    padding: .05rem .3rem;
    border: 1px solid currentColor;
    border-radius: var(--radius);
    font-size: .62rem;
    font-weight: 700;
    letter-spacing: .03em;
    text-transform: uppercase;
}

.csv-empty {
    padding: 1.25rem !important;
    color: var(--muted);
    text-align: center;
}

.csv-note {
    margin: .7rem 0 0;
    color: var(--muted);
    font-size: .78rem;
    line-height: 1.5;
}

/* QR Studio -------------------------------------------------------------- */

.qr-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(15rem, .85fr);
    gap: 1.25rem;
    align-items: start;
}

.qr-preview-wrap {
    padding: 1rem;
    border: 1px solid var(--line);
    background: var(--bg);
    text-align: center;
}

.qr-preview {
    display: block;
    width: 100%;
    max-width: 26rem;
    aspect-ratio: 1 / 1;
    height: auto;
    margin: 0 auto;
    image-rendering: pixelated;
    border: 1px solid var(--line);
    background: var(--surface);
}

.qr-divider {
    margin: 1.2rem 0;
    border: 0;
    border-top: 1px solid var(--line);
}

.qr-size-note {
    margin: .7rem 0 0;
    color: var(--muted);
    font-family: var(--font-mono);
    font-size: .7rem;
    line-height: 1.45;
}

.qr-color-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
}

.qr-color {
    width: 100%;
    min-height: 2.75rem;
    padding: .2rem;
    border: 1px solid var(--line-strong);
    border-radius: var(--radius);
    background: var(--bg);
    cursor: pointer;
}

.qr-color:focus-visible {
    outline: 2px solid var(--focus);
    outline-offset: 2px;
}

/* Duyarlı ---------------------------------------------------------------- */

@media (max-width: 991.98px) {
    .qr-layout {
        grid-template-columns: minmax(0, 1fr);
    }

    .csv-controls {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 767.98px) {
    .tool-grid,
    .tool-grid--three,
    .dev-grid,
    .dev-jwt-grid,
    .diff-layout {
        grid-template-columns: minmax(0, 1fr);
    }

    .csv-controls {
        grid-template-columns: minmax(0, 1fr);
    }

    .tool-meta__key {
        display: block;
        min-width: 0;
    }

    .image-item__main {
        align-items: stretch;
    }

    .image-thumb {
        max-width: 72px;
        max-height: 72px;
    }
}

@media (max-width: 575.98px) {
    .tool-panel {
        padding: 1rem;
    }

    .tool-actions .button {
        flex: 1 1 auto;
    }

    .diff-table {
        font-size: .72rem;
    }

    .diff-table__number {
        width: 2.6rem;
    }

    .diff-table__status {
        width: 2.2rem;
    }
}

@media (prefers-reduced-motion: reduce) {
    .dropzone,
    .button {
        transition: none;
    }
}

    </style>
</head>
<body>
<main>
<section class="section tool" aria-labelledby="tool-title">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <p class="section__label"><span class="section__num">Araç</span> Image Toolkit</p>
                <h1 class="section__title" id="tool-title">Görselleri tarayıcıda işle.</h1>
                <p class="section__intro">
                    JPEG, PNG ve WebP dosyalarını önizleyin; yeniden boyutlandırın, kırpın, sıkıştırın
                    veya seçilen biçime dönüştürün. Sonucu tek tek ya da toplu indirebilirsiniz.
                </p>

                <div class="tool-notice">
                    <h2 class="tool-notice__title">İşlemler tarayıcıda</h2>
                    <ul class="tool-notice__list">
                        <li>Çözme, kırpma, yeniden boyutlandırma ve kodlama Canvas API ile yapılır.</li>
                        <li>Dosya seçimi File API ile okunur; sonuçlar Blob adresleri üzerinden indirilir.</li>
                        <li>Sayfa yenilendiğinde seçili dosyalar ve indirme bağlantıları sıfırlanır.</li>
                    </ul>
                </div>

                <div class="tool-meta">
                    <h2 class="tool-meta__title">Biçim ve sınırlar</h2>
                    <ul class="tool-notes">
                        <li>Girdi: JPEG, PNG ve WebP. Çıktı seçenekleri tarayıcının gerçek kodlama yeteneğine göre belirlenir.</li>
                        <li>Dosya başına en fazla 20 MB, tek seferde en fazla 12 dosya.</li>
                        <li>Çıktı en fazla 8192 piksel kenar ve 24 megapiksel olabilir.</li>
                        <li>Animasyonlu PNG ve WebP dosyaları reddedilir; animasyon kaybıyla statik çıktı üretilmez.</li>
                        <li>Yeniden kodlama EXIF, GPS, ICC ve diğer metadata’yı kaldırır. Yön bilgisi tarayıcı tarafından uygulanır.</li>
                    </ul>
                </div>

                <div class="tool-meta">
                    <h2 class="tool-meta__title">Klavye ve erişilebilirlik</h2>
                    <p class="tool-meta__line">
                        Dosya seçimi, alanlar ve düğmeler klavyeyle kullanılabilir. Her dosyanın durumu
                        metinle bildirilir; renk tek başına anlam taşımaz.
                    </p>
                </div>
            </div>

            <div class="col-lg-7 offset-lg-1" data-image-tool>
                <div class="tool-panel">
                    <label class="dropzone" for="image-files" data-image-dropzone>
                        <input
                            class="visually-hidden"
                            id="image-files"
                            type="file"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            multiple
                        >
                        <span class="dropzone__icon" aria-hidden="true">&darr;</span>
                        <span class="dropzone__title">Görselleri buraya bırakın veya seçin</span>
                        <span class="dropzone__hint">JPEG, PNG, WebP · dosya başına en fazla 20 MB · en fazla 12 dosya</span>
                    </label>

                    <p class="tool-empty" data-image-empty>Henüz görsel eklenmedi. Seçim yaptığınızda dosyalar listelenir.</p>
                    <ul class="image-list" data-image-list aria-live="polite"></ul>
                </div>

                <div class="tool-panel">
                    <div class="tool-grid">
                        <div class="tool-field">
                            <label class="tool-label" for="image-target">Hedef biçim</label>
                            <select class="tool-select" id="image-target" aria-describedby="image-target-hint">
                                <option value="auto">Kaynak biçimini koru</option>
                            </select>
                            <p class="tool-field__hint" id="image-target-hint" data-image-support>
                                Tarayıcı desteği denetleniyor…
                            </p>
                        </div>

                        <div class="tool-field">
                            <label class="tool-label" for="image-quality">Sıkıştırma kalitesi</label>
                            <div class="tool-row">
                                <input class="tool-input" id="image-quality" type="range" min="0.1" max="1" step="0.05" value="0.85" aria-describedby="image-quality-hint">
                                <output for="image-quality" data-image-quality-value>85%</output>
                            </div>
                            <p class="tool-field__hint" id="image-quality-hint">JPEG ve WebP için geçerlidir; PNG’de yok sayılır.</p>
                        </div>
                    </div>

                    <div class="tool-grid tool-grid--three">
                        <div class="tool-field">
                            <label class="tool-label" for="image-width">Genişlik (px)</label>
                            <input class="tool-input" id="image-width" type="number" min="0" step="1" inputmode="numeric" placeholder="Otomatik">
                        </div>
                        <div class="tool-field">
                            <label class="tool-label" for="image-height">Yükseklik (px)</label>
                            <input class="tool-input" id="image-height" type="number" min="0" step="1" inputmode="numeric" placeholder="Otomatik">
                        </div>
                        <div class="tool-field">
                            <span class="tool-label">Oran</span>
                            <label class="tool-check">
                                <input id="image-keep-aspect" type="checkbox" checked>
                                En-boy oranını koru
                            </label>
                        </div>
                    </div>

                    <fieldset class="tool-field">
                        <legend class="tool-legend">Kırpma (isteğe bağlı)</legend>
                        <div class="tool-grid">
                            <div class="tool-field">
                                <label class="tool-label" for="image-crop-x">Sol (X)</label>
                                <input class="tool-input" id="image-crop-x" type="number" min="0" step="1" inputmode="numeric" placeholder="0">
                            </div>
                            <div class="tool-field">
                                <label class="tool-label" for="image-crop-y">Üst (Y)</label>
                                <input class="tool-input" id="image-crop-y" type="number" min="0" step="1" inputmode="numeric" placeholder="0">
                            </div>
                            <div class="tool-field">
                                <label class="tool-label" for="image-crop-w">Genişlik</label>
                                <input class="tool-input" id="image-crop-w" type="number" min="1" step="1" inputmode="numeric" placeholder="Görsel genişliği">
                            </div>
                            <div class="tool-field">
                                <label class="tool-label" for="image-crop-h">Yükseklik</label>
                                <input class="tool-input" id="image-crop-h" type="number" min="1" step="1" inputmode="numeric" placeholder="Görsel yüksekliği">
                            </div>
                        </div>
                        <p class="tool-field__hint">Dört alanı da doldurun veya hepsini boş bırakın. Kırpma tüm dosyalara uygulanır.</p>
                    </fieldset>

                    <div class="image-preview-wrap">
                        <canvas class="image-preview" id="image-preview" data-image-preview width="1" height="1" role="img" aria-label="Seçili görselin işlenmiş önizlemesi"></canvas>
                        <p class="image-preview-note" data-image-preview-note>Bir görsel seçildiğinde çıktı burada önizlenir.</p>
                    </div>

                    <div class="tool-actions">
                        <button class="button button--primary" type="button" data-image-convert disabled>Dönüştür</button>
                        <button class="button button--quiet" type="button" data-image-download-all disabled>Tümünü indir</button>
                        <button class="button button--quiet" type="button" data-image-clear disabled>Listeyi temizle</button>
                    </div>

                    <p class="tool-status" role="status" aria-live="polite" data-image-status></p>

                    <noscript>
                        <p class="tool-noscript">Bu araç tamamen JavaScript ile çalışır. JavaScript kapalıyken görsel işleme yapılamaz.</p>
                    </noscript>
                </div>
</div>
        </div>
    </div>
</section>
</main>
<script>
/*
 * Tarayıcı araçları için ortak yardımcılar.
 *
 * Bu dosya sunucuya istek göndermez; tüm yardımcılar dosyanın içinde
 * tanımlıdır ve başka bir dosyaya bağımlılık yoktur.
 */
(function (root, factory) {
    'use strict';

    root.PortfolioTools = root.PortfolioTools || {};
    root.PortfolioTools.common = factory();
}(typeof globalThis !== 'undefined' ? globalThis : this, function () {
    'use strict';

    function formatBytes(bytes) {
        var value = Number(bytes);

        if (!isFinite(value) || value < 0) {
            return '0 B';
        }

        if (value < 1024) {
            return Math.round(value) + ' B';
        }

        if (value < 1024 * 1024) {
            return (value / 1024).toFixed(1).replace('.', ',') + ' KB';
        }

        if (value < 1024 * 1024 * 1024) {
            return (value / (1024 * 1024)).toFixed(1).replace('.', ',') + ' MB';
        }

        return (value / (1024 * 1024 * 1024)).toFixed(2).replace('.', ',') + ' GB';
    }

    function safeFilename(name, fallback) {
        var value = typeof name === 'string' ? name : '';
        value = value.replace(/[\\/:*?"<>|\u0000-\u001f\u007f]/g, '-');
        value = value.replace(/\s+/g, ' ').trim();
        value = value.replace(/^\.+/, '');

        if (value === '') {
            value = typeof fallback === 'string' && fallback !== '' ? fallback : 'dosya';
        }

        if (value.length > 120) {
            value = value.slice(0, 120);
        }

        return value;
    }

    function debounce(callback, wait) {
        var timer = null;

        return function () {
            var args = arguments;
            var context = this;

            if (timer !== null) {
                clearTimeout(timer);
            }

            timer = setTimeout(function () {
                timer = null;
                callback.apply(context, args);
            }, wait);
        };
    }

    function setStatus(element, message, isError) {
        if (!element) {
            return;
        }

        element.textContent = message || '';
        element.classList.toggle('is-error', Boolean(isError));
    }

    function downloadBlob(blob, filename) {
        if (!blob || typeof document === 'undefined') {
            return false;
        }

        var url = URL.createObjectURL(blob);
        var link = document.createElement('a');

        link.href = url;
        link.download = safeFilename(filename, 'indirme');
        link.rel = 'noopener';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        setTimeout(function () {
            URL.revokeObjectURL(url);
        }, 30000);

        return true;
    }

    function downloadText(text, mime, filename) {
        return downloadBlob(new Blob([text], { type: mime + ';charset=utf-8' }), filename);
    }

    function copyText(text) {
        if (typeof navigator !== 'undefined' && navigator.clipboard && typeof navigator.clipboard.writeText === 'function') {
            return navigator.clipboard.writeText(text);
        }

        return new Promise(function (resolve, reject) {
            if (typeof document === 'undefined') {
                reject(new Error('Panoya kopyalama bu ortamda kullanılamıyor.'));
                return;
            }

            var area = document.createElement('textarea');
            area.value = text;
            area.setAttribute('readonly', 'readonly');
            area.className = 'visually-hidden';
            document.body.appendChild(area);
            area.select();

            try {
                var copied = document.execCommand('copy');
                document.body.removeChild(area);

                if (copied) {
                    resolve();
                } else {
                    reject(new Error('Panoya kopyalama tarayıcı tarafından engellendi.'));
                }
            } catch (error) {
                document.body.removeChild(area);
                reject(new Error('Panoya kopyalama bu tarayıcıda desteklenmiyor.'));
            }
        });
    }

    function extensionOf(name) {
        var value = typeof name === 'string' ? name : '';
        var dot = value.lastIndexOf('.');

        return dot > 0 ? value.slice(dot + 1).toLowerCase() : '';
    }

    function baseName(name) {
        var value = typeof name === 'string' ? name : '';
        var dot = value.lastIndexOf('.');

        return dot > 0 ? value.slice(0, dot) : value;
    }

    return {
        formatBytes: formatBytes,
        safeFilename: safeFilename,
        debounce: debounce,
        setStatus: setStatus,
        downloadBlob: downloadBlob,
        downloadText: downloadText,
        copyText: copyText,
        extensionOf: extensionOf,
        baseName: baseName
    };
}));

/*
 * Image Toolkit — JPEG, PNG ve WebP için yerel görsel işleme.
 *
 * Görseller sunucuya gönderilmez. Yeniden kodlama EXIF/GPS/ICC gibi
 * metadata'yı kaldırır; animasyonlu PNG/WebP dosyaları reddedilir.
 */
(function (root, factory) {
    'use strict';

    root.PortfolioTools = root.PortfolioTools || {};
    root.PortfolioTools.imageToolkit = factory(root.PortfolioTools.common);
}(typeof globalThis !== 'undefined' ? globalThis : this, function (common) {
    'use strict';

    var MAX_FILES = 12;
    var MAX_INPUT_BYTES = 20 * 1024 * 1024;
    var MAX_DIMENSION = 8192;
    var MAX_PIXELS = 24000000;

    var FORMATS = [
        { mime: 'image/jpeg', extension: 'jpg', label: 'JPEG' },
        { mime: 'image/png', extension: 'png', label: 'PNG' },
        { mime: 'image/webp', extension: 'webp', label: 'WebP' }
    ];

    function formatBytes(bytes) {
        return common.formatBytes(bytes);
    }

    function toBytes(input) {
        if (input instanceof Uint8Array) {
            return input;
        }

        if (input instanceof ArrayBuffer) {
            return new Uint8Array(input);
        }

        if (ArrayBuffer.isView(input)) {
            return new Uint8Array(input.buffer, input.byteOffset, input.byteLength);
        }

        return new Uint8Array(0);
    }

    function sniffImageType(input) {
        var bytes = toBytes(input);

        if (bytes.length >= 3 && bytes[0] === 0xFF && bytes[1] === 0xD8 && bytes[2] === 0xFF) {
            return { mime: 'image/jpeg', extension: 'jpg', label: 'JPEG' };
        }

        if (bytes.length >= 8
            && bytes[0] === 0x89 && bytes[1] === 0x50 && bytes[2] === 0x4E && bytes[3] === 0x47
            && bytes[4] === 0x0D && bytes[5] === 0x0A && bytes[6] === 0x1A && bytes[7] === 0x0A) {
            return { mime: 'image/png', extension: 'png', label: 'PNG' };
        }

        if (bytes.length >= 12
            && bytes[0] === 0x52 && bytes[1] === 0x49 && bytes[2] === 0x46 && bytes[3] === 0x46
            && bytes[8] === 0x57 && bytes[9] === 0x45 && bytes[10] === 0x42 && bytes[11] === 0x50) {
            return { mime: 'image/webp', extension: 'webp', label: 'WebP' };
        }

        return null;
    }

    function isAnimatedPng(bytes) {
        var view = new DataView(bytes.buffer, bytes.byteOffset, bytes.byteLength);
        var offset = 8;

        while (offset + 12 <= bytes.length) {
            var length = view.getUint32(offset, false);
            var type = String.fromCharCode(bytes[offset + 4], bytes[offset + 5], bytes[offset + 6], bytes[offset + 7]);

            if (type === 'acTL') {
                return true;
            }

            if (type === 'IDAT') {
                return false;
            }

            if (length > bytes.length - offset - 12) {
                return false;
            }

            offset += length + 12;
        }

        return false;
    }

    function isAnimatedWebp(bytes) {
        var view = new DataView(bytes.buffer, bytes.byteOffset, bytes.byteLength);
        var offset = 12;

        while (offset + 8 <= bytes.length) {
            var type = String.fromCharCode(bytes[offset], bytes[offset + 1], bytes[offset + 2], bytes[offset + 3]);
            var length = view.getUint32(offset + 4, true);

            if (type === 'ANIM' || type === 'ANMF') {
                return true;
            }

            if (length > bytes.length - offset - 8) {
                return false;
            }

            offset += 8 + length + (length % 2);
        }

        return false;
    }

    function isAnimated(input, mime) {
        var bytes = toBytes(input);
        var type = mime || (sniffImageType(bytes) || {}).mime;

        if (type === 'image/png') {
            return isAnimatedPng(bytes);
        }

        if (type === 'image/webp') {
            return isAnimatedWebp(bytes);
        }

        return false;
    }

    function validateCrop(crop, width, height) {
        if (!crop) {
            return null;
        }

        var values = ['x', 'y', 'w', 'h'].map(function (key) {
            return Number(crop[key]);
        });

        if (!values.every(function (value) {
            return isFinite(value) && Math.floor(value) === value;
        })) {
            throw new Error('Kırpma değerleri tam sayı olmalıdır.');
        }

        var x = values[0];
        var y = values[1];
        var w = values[2];
        var h = values[3];

        if (x < 0 || y < 0 || w < 1 || h < 1) {
            throw new Error('Kırpma alanı negatif olamaz; genişlik ve yükseklik en az 1 olmalıdır.');
        }

        if (x + w > width || y + h > height) {
            throw new Error('Kırpma alanı görselin dışına taşıyor. Görsel boyutu: ' + width + ' × ' + height + '.');
        }

        return { x: x, y: y, w: w, h: h };
    }

    function optionalSize(value) {
        if (value === null || value === undefined || value === '') {
            return 0;
        }

        var number = Number(value);

        if (!isFinite(number) || Math.floor(number) !== number || number < 0) {
            throw new Error('Yeniden boyutlandırma değerleri sıfır veya pozitif tam sayı olmalıdır.');
        }

        return number;
    }

    function computeDimensions(sourceWidth, sourceHeight, crop, resizeWidth, resizeHeight, keepAspect) {
        sourceWidth = Number(sourceWidth);
        sourceHeight = Number(sourceHeight);

        if (!isFinite(sourceWidth) || !isFinite(sourceHeight) || sourceWidth < 1 || sourceHeight < 1) {
            throw new Error('Görsel boyutları okunamadı.');
        }

        var area = validateCrop(crop, sourceWidth, sourceHeight) || {
            x: 0,
            y: 0,
            w: sourceWidth,
            h: sourceHeight
        };
        var width = optionalSize(resizeWidth);
        var height = optionalSize(resizeHeight);
        var outputWidth;
        var outputHeight;

        if (width > 0 && height > 0) {
            if (keepAspect) {
                var scale = Math.min(width / area.w, height / area.h);
                outputWidth = Math.max(1, Math.round(area.w * scale));
                outputHeight = Math.max(1, Math.round(area.h * scale));
            } else {
                outputWidth = width;
                outputHeight = height;
            }
        } else if (width > 0) {
            outputWidth = width;
            outputHeight = Math.max(1, Math.round(area.h * width / area.w));
        } else if (height > 0) {
            outputHeight = height;
            outputWidth = Math.max(1, Math.round(area.w * height / area.h));
        } else {
            outputWidth = area.w;
            outputHeight = area.h;
        }

        if (outputWidth > MAX_DIMENSION || outputHeight > MAX_DIMENSION) {
            throw new Error('Çıktı boyutu en fazla ' + MAX_DIMENSION + ' piksel olabilir.');
        }

        if (outputWidth * outputHeight > MAX_PIXELS) {
            throw new Error('Çıktı 24 megapiksel sınırını aşıyor. Daha küçük bir boyut seçin.');
        }

        return {
            sx: area.x,
            sy: area.y,
            sw: area.w,
            sh: area.h,
            width: outputWidth,
            height: outputHeight
        };
    }

    function outputName(name, mime) {
        var base = String(name || 'gorsel').replace(/\.[^.]+$/, '');
        var format = FORMATS.filter(function (entry) {
            return entry.mime === mime;
        })[0];
        var extension = format ? format.extension : 'png';

        base = base.replace(/[\\/:*?"<>|\u0000-\u001f\u007f]/g, '-').trim() || 'gorsel';

        return base + '.' + extension;
    }

    function extensionOf(name) {
        return common.extensionOf(name);
    }

    function extensionMatches(name, mime) {
        var extension = extensionOf(name);

        if (extension === '') {
            return true;
        }

        if (mime === 'image/jpeg') {
            return extension === 'jpg' || extension === 'jpeg';
        }

        if (mime === 'image/png') {
            return extension === 'png';
        }

        if (mime === 'image/webp') {
            return extension === 'webp';
        }

        return false;
    }

    function init() {
        if (typeof document === 'undefined') {
            return;
        }

        var tool = document.querySelector('[data-image-tool]');

        if (!tool) {
            return;
        }

        var input = document.getElementById('image-files');
        var dropzone = document.querySelector('[data-image-dropzone]');
        var list = document.querySelector('[data-image-list]');
        var empty = document.querySelector('[data-image-empty]');
        var status = document.querySelector('[data-image-status]');
        var targetSelect = document.getElementById('image-target');
        var supportNote = document.querySelector('[data-image-support]');
        var preview = document.querySelector('[data-image-preview]');
        var previewNote = document.querySelector('[data-image-preview-note]');
        var quality = document.getElementById('image-quality');
        var qualityValue = document.querySelector('[data-image-quality-value]');
        var resizeWidth = document.getElementById('image-width');
        var resizeHeight = document.getElementById('image-height');
        var keepAspect = document.getElementById('image-keep-aspect');
        var cropX = document.getElementById('image-crop-x');
        var cropY = document.getElementById('image-crop-y');
        var cropW = document.getElementById('image-crop-w');
        var cropH = document.getElementById('image-crop-h');
        var convertButton = document.querySelector('[data-image-convert]');
        var clearButton = document.querySelector('[data-image-clear]');
        var downloadAll = document.querySelector('[data-image-download-all]');

        if (!input || !list || !empty || !status || !targetSelect || !preview) {
            return;
        }

        var items = [];
        var active = null;
        var running = false;
        var supported = [];
        var previewQueue = null;

        function setStatus(message, isError) {
            status.textContent = message || '';
            status.classList.toggle('is-error', Boolean(isError));
        }

        function checkFormatSupport() {
            var canvas = document.createElement('canvas');
            canvas.width = 1;
            canvas.height = 1;

            return Promise.all(FORMATS.map(function (format) {
                return new Promise(function (resolve) {
                    if (typeof canvas.toBlob !== 'function') {
                        resolve({ format: format, supported: false });
                        return;
                    }

                    canvas.toBlob(function (blob) {
                        resolve({
                            format: format,
                            supported: Boolean(blob) && blob.type === format.mime
                        });
                    }, format.mime, 0.8);
                });
            }));
        }

        function fillTargets(results) {
            targetSelect.textContent = '';

            var auto = document.createElement('option');
            auto.value = 'auto';
            auto.textContent = 'Kaynak biçimini koru';
            targetSelect.appendChild(auto);

            supported = results.filter(function (entry) {
                return entry.supported;
            });

            results.forEach(function (entry) {
                var option = document.createElement('option');
                option.value = entry.format.mime;
                option.textContent = entry.format.label;
                option.disabled = !entry.supported;
                targetSelect.appendChild(option);
            });

            if (supported.length === 0) {
                targetSelect.disabled = true;
                convertButton.disabled = true;
                setStatus('Bu tarayıcı JPEG, PNG veya WebP kodlamasını desteklemiyor.', true);
            } else if (status.textContent === 'Hedef biçim desteği denetleniyor…') {
                setStatus('');
            }

            if (supportNote) {
                var unsupported = results.filter(function (entry) {
                    return !entry.supported;
                }).map(function (entry) {
                    return entry.format.label;
                });
                supportNote.textContent = unsupported.length > 0
                    ? 'Bu tarayıcı şu hedef biçimleri kodlayamıyor: ' + unsupported.join(', ') + '. Bu seçenekler devre dışı.'
                    : 'JPEG, PNG ve WebP kodlaması bu tarayıcıda doğrulandı.';
            }
        }

        function updateQuality() {
            if (!quality || !qualityValue) {
                return;
            }

            qualityValue.textContent = Math.round(Number(quality.value) * 100) + '%';
        }

        function setPlaceholders() {
            if (!active) {
                return;
            }

            if (cropW) {
                cropW.placeholder = String(active.width);
            }
            if (cropH) {
                cropH.placeholder = String(active.height);
            }
        }

        function readCrop() {
            if (!active) {
                return null;
            }

            var raw = [cropX, cropY, cropW, cropH].map(function (field) {
                return field ? field.value.trim() : '';
            });

            if (raw.every(function (value) {
                return value === '';
            })) {
                return null;
            }

            if (raw.some(function (value) {
                return value === '';
            })) {
                throw new Error('Kırpma için X, Y, genişlik ve yükseklik alanlarının tümünü doldurun veya hepsini boş bırakın.');
            }

            return validateCrop({
                x: Number(raw[0]),
                y: Number(raw[1]),
                w: Number(raw[2]),
                h: Number(raw[3])
            }, active.width, active.height);
        }

        function drawPreview() {
            if (!active || !preview) {
                return;
            }

            try {
                var crop = readCrop();
                var dims = computeDimensions(
                    active.width,
                    active.height,
                    crop,
                    resizeWidth ? resizeWidth.value : '',
                    resizeHeight ? resizeHeight.value : '',
                    keepAspect ? keepAspect.checked : true
                );
                var maxWidth = 560;
                var scale = Math.min(1, maxWidth / dims.width);
                var canvasWidth = Math.max(1, Math.round(dims.width * scale));
                var canvasHeight = Math.max(1, Math.round(dims.height * scale));
                var context;

                preview.width = canvasWidth;
                preview.height = canvasHeight;
                context = preview.getContext('2d');

                if (!context) {
                    throw new Error('Önizleme canvas bağlamı oluşturulamadı.');
                }

                context.clearRect(0, 0, canvasWidth, canvasHeight);
                context.imageSmoothingEnabled = true;
                context.imageSmoothingQuality = 'high';
                context.drawImage(active.bitmap, dims.sx, dims.sy, dims.sw, dims.sh, 0, 0, canvasWidth, canvasHeight);

                if (previewNote) {
                    previewNote.textContent = 'Çıktı: ' + dims.width + ' × ' + dims.height + ' piksel'
                        + (crop ? ' · kırpma ' + crop.w + ' × ' + crop.h : '')
                        + (scale < 1 ? ' · önizleme ölçeklendi' : '');
                }

                setStatus('');
            } catch (error) {
                preview.width = 1;
                preview.height = 1;
                if (previewNote) {
                    previewNote.textContent = '';
                }
                setStatus(error.message, true);
            }
        }

        function schedulePreview() {
            if (previewQueue !== null) {
                clearTimeout(previewQueue);
            }

            previewQueue = setTimeout(function () {
                previewQueue = null;
                drawPreview();
            }, 100);
        }

        function makeThumbnail(item) {
            var canvas = document.createElement('canvas');
            var max = 104;
            var scale = Math.min(max / item.width, max / item.height, 1);
            var width = Math.max(1, Math.round(item.width * scale));
            var height = Math.max(1, Math.round(item.height * scale));
            var context;

            canvas.width = width;
            canvas.height = height;
            canvas.className = 'image-thumb';
            context = canvas.getContext('2d');

            if (context) {
                context.drawImage(item.bitmap, 0, 0, width, height);
            }

            return canvas;
        }

        function releaseItem(item) {
            if (item.resultUrl) {
                URL.revokeObjectURL(item.resultUrl);
                item.resultUrl = '';
            }

            if (item.bitmap && typeof item.bitmap.close === 'function') {
                item.bitmap.close();
            }
        }

        function buildItem(file, bitmap, sniffed) {
            var li = document.createElement('li');
            var main = document.createElement('div');
            var text = document.createElement('div');
            var name = document.createElement('p');
            var meta = document.createElement('p');
            var state = document.createElement('p');
            var actions = document.createElement('div');
            var activate = document.createElement('button');
            var remove = document.createElement('button');
            var result = document.createElement('p');
            var item = {
                file: file,
                bitmap: bitmap,
                sniffed: sniffed,
                width: bitmap.width,
                height: bitmap.height,
                li: li,
                stateEl: state,
                resultEl: result,
                resultUrl: '',
                resultBlob: null,
                resultName: '',
                state: 'ready'
            };

            li.className = 'image-item';
            main.className = 'image-item__main';
            text.className = 'image-item__text';
            name.className = 'image-item__name';
            name.textContent = file.name;
            meta.className = 'image-item__meta';
            meta.textContent = sniffed.label + ' · ' + item.width + ' × ' + item.height + ' · ' + formatBytes(file.size)
                + (extensionMatches(file.name, sniffed.mime) ? '' : ' · uzantı içerikle uyuşmuyor');
            state.className = 'image-item__state';
            state.textContent = 'Hazır.';
            actions.className = 'image-item__actions';
            activate.type = 'button';
            activate.className = 'button button--quiet';
            activate.textContent = 'Önizle';
            remove.type = 'button';
            remove.className = 'image-item__remove';
            remove.textContent = 'Kaldır';
            remove.setAttribute('aria-label', file.name + ' dosyasını listeden çıkar');
            result.className = 'image-item__result';
            result.hidden = true;

            main.appendChild(makeThumbnail(item));
            text.appendChild(name);
            text.appendChild(meta);
            text.appendChild(state);
            actions.appendChild(activate);
            actions.appendChild(remove);
            text.appendChild(actions);
            text.appendChild(result);
            main.appendChild(text);
            li.appendChild(main);
            list.appendChild(li);

            activate.addEventListener('click', function () {
                active = item;
                setPlaceholders();
                drawPreview();
                setStatus(file.name + ' önizleniyor.');
            });

            remove.addEventListener('click', function () {
                if (running) {
                    return;
                }

                var index = items.indexOf(item);

                if (index !== -1) {
                    items.splice(index, 1);
                }

                releaseItem(item);

                if (item.li.parentNode) {
                    item.li.parentNode.removeChild(item.li);
                }

                if (active === item) {
                    active = items.length > 0 ? items[0] : null;
                    setPlaceholders();
                    drawPreview();
                }

                updateControls();
            });

            return item;
        }

        function updateControls() {
            empty.hidden = items.length > 0;
            convertButton.disabled = running || items.length === 0 || supported.length === 0;
            clearButton.disabled = running || items.length === 0;
            downloadAll.disabled = running || items.filter(function (item) {
                return item.state === 'done';
            }).length === 0;

            if (items.length === 0) {
                preview.width = 1;
                preview.height = 1;

                if (previewNote) {
                    previewNote.textContent = 'Bir görsel seçildiğinde çıktı burada önizlenir.';
                }
            }
        }

        function decodeWithImage(blob) {
            return new Promise(function (resolve, reject) {
                var url = URL.createObjectURL(blob);
                var image = new Image();

                image.onload = function () {
                    URL.revokeObjectURL(url);
                    resolve(image);
                };
                image.onerror = function () {
                    URL.revokeObjectURL(url);
                    reject(new Error('Görsel çözülemedi.'));
                };
                image.src = url;
            });
        }

        function decodeBlob(blob) {
            if (typeof createImageBitmap === 'function') {
                return createImageBitmap(blob, { imageOrientation: 'from-image' })
                    .catch(function () {
                        return createImageBitmap(blob);
                    })
                    .catch(function () {
                        /* Bazı geçerli JPEG'ler createImageBitmap'de çözülemiyor; <img> yedeği kullanılır. */
                        return decodeWithImage(blob);
                    });
            }

            return decodeWithImage(blob);
        }

        function addFiles(fileList) {
            var files = Array.prototype.slice.call(fileList || []);

            if (files.length === 0) {
                return;
            }

            var remaining = MAX_FILES - items.length;

            if (remaining <= 0) {
                setStatus('En fazla ' + MAX_FILES + ' dosya ekleyebilirsiniz.', true);
                return;
            }

            files.slice(0, remaining).forEach(function (file) {
                if (file.size > MAX_INPUT_BYTES) {
                    setStatus(file.name + ' çok büyük. Dosya başına sınır 20 MB.', true);
                    return;
                }

                file.arrayBuffer().then(function (buffer) {
                    var bytes = new Uint8Array(buffer);
                    var sniffed = sniffImageType(bytes);

                    if (!sniffed) {
                        setStatus(file.name + ' JPEG, PNG veya WebP imzası taşımıyor.', true);
                        return;
                    }

                    if (isAnimated(bytes, sniffed.mime)) {
                        setStatus(file.name + ' animasyonlu bir ' + sniffed.label + ' dosyası. Animasyon korunamayacağı için reddedildi; statik sürüm üretilmedi.', true);
                        return;
                    }

                    var blob = new Blob([bytes], { type: sniffed.mime });

                    decodeBlob(blob).then(function (bitmap) {
                        if (items.length >= MAX_FILES) {
                            if (typeof bitmap.close === 'function') {
                                bitmap.close();
                            }
                            return;
                        }

                        var item = buildItem(file, bitmap, sniffed);
                        items.push(item);
                        active = item;
                        setPlaceholders();
                        drawPreview();
                        updateControls();
                        setStatus(file.name + ' eklendi. ' + items.length + ' dosya listede.');
                    }).catch(function () {
                        setStatus(file.name + ' tarayıcıda çözülemedi. Dosya bozuk olabilir veya bu tarayıcı biçimi desteklemiyor.', true);
                    });
                }).catch(function () {
                    setStatus(file.name + ' okunamadı.', true);
                });
            });

            if (files.length > remaining) {
                setStatus('Yalnızca ilk ' + remaining + ' dosya eklendi; en fazla ' + MAX_FILES + ' dosya desteklenir.', true);
            }
        }

        function toBlob(canvas, mime, qualityValueNumber) {
            return new Promise(function (resolve, reject) {
                if (typeof canvas.toBlob !== 'function') {
                    reject(new Error('Canvas kodlaması bu tarayıcıda desteklenmiyor.'));
                    return;
                }

                canvas.toBlob(function (blob) {
                    if (!blob) {
                        reject(new Error('Çıktı üretilemedi; bu biçim desteklenmiyor olabilir.'));
                        return;
                    }

                    resolve(blob);
                }, mime, qualityValueNumber);
            });
        }

        function convertItem(item, target) {
            return new Promise(function (resolve) {
                var mime = target === 'auto' ? item.sniffed.mime : target;
                var dims;
                var canvas;
                var context;

                try {
                    dims = computeDimensions(
                        item.width,
                        item.height,
                        readCrop(),
                        resizeWidth ? resizeWidth.value : '',
                        resizeHeight ? resizeHeight.value : '',
                        keepAspect ? keepAspect.checked : true
                    );
                } catch (error) {
                    item.state = 'error';
                    item.stateEl.textContent = error.message;
                    item.stateEl.classList.add('is-error');
                    resolve(false);
                    return;
                }

                item.state = 'working';
                item.stateEl.textContent = 'Dönüştürülüyor…';
                item.stateEl.classList.remove('is-error');
                item.resultEl.hidden = true;

                if (item.resultUrl) {
                    URL.revokeObjectURL(item.resultUrl);
                    item.resultUrl = '';
                }

                canvas = document.createElement('canvas');
                canvas.width = dims.width;
                canvas.height = dims.height;
                context = canvas.getContext('2d');

                if (!context) {
                    item.state = 'error';
                    item.stateEl.textContent = 'Canvas bağlamı oluşturulamadı.';
                    item.stateEl.classList.add('is-error');
                    resolve(false);
                    return;
                }

                context.imageSmoothingEnabled = true;
                context.imageSmoothingQuality = 'high';
                context.drawImage(item.bitmap, dims.sx, dims.sy, dims.sw, dims.sh, 0, 0, dims.width, dims.height);

                toBlob(canvas, mime, mime === 'image/png' ? undefined : (quality ? Number(quality.value) : 0.85)).then(function (blob) {
                    if (blob.type !== mime) {
                        throw new Error('Tarayıcı istenen biçimi kodlamadı (dönen tür: ' + (blob.type || 'bilinmiyor') + ').');
                    }

                    item.resultBlob = blob;
                    item.resultName = outputName(item.file.name, mime);
                    item.resultUrl = URL.createObjectURL(blob);
                    item.state = 'done';
                    item.stateEl.textContent = 'Tamamlandı: ' + dims.width + ' × ' + dims.height + ' · ' + formatBytes(blob.size);

                    var link = document.createElement('a');
                    link.href = item.resultUrl;
                    link.download = item.resultName;
                    link.className = 'image-download';
                    link.textContent = 'İndir: ' + item.resultName;
                    item.resultEl.textContent = '';
                    item.resultEl.appendChild(link);
                    item.resultEl.hidden = false;
                    resolve(true);
                }).catch(function (error) {
                    item.state = 'error';
                    item.stateEl.textContent = error.message;
                    item.stateEl.classList.add('is-error');
                    resolve(false);
                });
            });
        }

        function convertAll() {
            if (running || items.length === 0) {
                return;
            }

            running = true;
            updateControls();
            setStatus('Dönüştürme başladı…');

            var pending = items.filter(function (item) {
                return item.state !== 'done';
            });
            var index = 0;

            function next() {
                if (index >= pending.length) {
                    running = false;
                    updateControls();
                    var failed = items.filter(function (item) {
                        return item.state === 'error';
                    }).length;
                    setStatus(failed > 0
                        ? failed + ' dosya dönüştürülemedi. Ayrıntılar listede.'
                        : pending.length + ' dosya dönüştürüldü. İndirme bağlantıları listede.', failed > 0);
                    return;
                }

                var item = pending[index];
                index += 1;
                setStatus(index + ' / ' + pending.length + ' dönüştürülüyor…');
                convertItem(item, targetSelect.value).then(next);
            }

            next();
        }

        targetSelect.addEventListener('change', function () {
            updateQuality();
        });

        if (quality) {
            quality.addEventListener('input', updateQuality);
        }

        [resizeWidth, resizeHeight, cropX, cropY, cropW, cropH].forEach(function (field) {
            if (field) {
                field.addEventListener('input', schedulePreview);
            }
        });

        if (keepAspect) {
            keepAspect.addEventListener('change', schedulePreview);
        }

        convertButton.addEventListener('click', convertAll);
        input.addEventListener('change', function () {
            addFiles(input.files);
            input.value = '';
        });

        if (clearButton) {
            clearButton.addEventListener('click', function () {
                if (running) {
                    return;
                }

                items.forEach(releaseItem);
                items = [];
                active = null;
                list.textContent = '';
                preview.width = 1;
                preview.height = 1;
                [cropX, cropY, cropW, cropH, resizeWidth, resizeHeight].forEach(function (field) {
                    if (field) {
                        field.value = '';
                    }
                });
                updateControls();
                setStatus('Liste temizlendi.');
            });
        }

        if (downloadAll) {
            downloadAll.addEventListener('click', function () {
                var done = items.filter(function (item) {
                    return item.state === 'done' && item.resultUrl;
                });

                done.forEach(function (item, index) {
                    setTimeout(function () {
                        var link = document.createElement('a');
                        link.href = item.resultUrl;
                        link.download = item.resultName;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }, index * 150);
                });

                setStatus(done.length + ' indirme başlatıldı. Tarayıcı çoklu indirmeyi engellerse bağlantıları tek tek kullanın.');
            });
        }

        if (dropzone) {
            ['dragenter', 'dragover'].forEach(function (name) {
                dropzone.addEventListener(name, function (event) {
                    event.preventDefault();
                    dropzone.classList.add('is-dragover');
                });
            });

            ['dragleave', 'drop'].forEach(function (name) {
                dropzone.addEventListener(name, function (event) {
                    event.preventDefault();
                    dropzone.classList.remove('is-dragover');
                });
            });

            dropzone.addEventListener('drop', function (event) {
                if (event.dataTransfer && event.dataTransfer.files) {
                    addFiles(event.dataTransfer.files);
                }
            });
        }

        updateQuality();
        updateControls();
        setStatus('Hedef biçim desteği denetleniyor…');
        checkFormatSupport().then(fillTargets).catch(function () {
            setStatus('Tarayıcı biçim desteği denetlenemedi.', true);
        });
    }

    if (typeof document !== 'undefined') {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    }

    return {
        MAX_FILES: MAX_FILES,
        MAX_INPUT_BYTES: MAX_INPUT_BYTES,
        MAX_DIMENSION: MAX_DIMENSION,
        MAX_PIXELS: MAX_PIXELS,
        FORMATS: FORMATS,
        formatBytes: formatBytes,
        sniffImageType: sniffImageType,
        isAnimatedPng: isAnimatedPng,
        isAnimatedWebp: isAnimatedWebp,
        isAnimated: isAnimated,
        validateCrop: validateCrop,
        computeDimensions: computeDimensions,
        outputName: outputName,
        extensionMatches: extensionMatches
    };
}));

</script>
</body>
</html>
