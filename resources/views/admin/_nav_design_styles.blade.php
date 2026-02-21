<style>
.component-builder { display:grid; grid-template-columns: 260px 1fr; gap:16px; align-items:start; }
@media (max-width:960px){ .component-builder { grid-template-columns: 1fr; } }
.component-library { background:#0f172a; color:#e2e8f0; border-radius:12px; padding:14px; box-shadow:0 10px 24px rgba(0,0,0,0.12); }
.component-library h3 { margin:0 0 6px; color:#e2e8f0; }
.component-library p { margin:0 0 12px; color:#cbd5e1; }
.component-library .component-item { padding:10px 12px; margin-bottom:8px; border:1px dashed rgba(255,255,255,0.25); border-radius:10px; cursor:pointer; background:rgba(255,255,255,0.05); color:#e2e8f0; display:flex; align-items:center; gap:10px; transition:background .2s,border .2s; }
.component-library .component-item:hover { background:rgba(255,255,255,0.12); border-color:rgba(255,255,255,0.4); }
.component-library .component-item i { color:#38bdf8; }

.component-canvas { background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:14px; box-shadow:0 10px 24px rgba(15,23,42,0.06); }
.component-canvas h3 { margin:0 0 10px; color:#0f172a; }
#componentList { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:10px; }
#componentList li { background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:10px 12px; display:flex; align-items:center; justify-content:space-between; gap:10px; box-shadow:0 4px 10px rgba(0,0,0,0.04); }
#componentList li .left { display:flex; align-items:center; gap:10px; }
.handle { cursor:grab; color:#94a3b8; }
.comp-pill { font-size:12px; font-weight:700; color:#0ea5e9; background:#e0f2fe; padding:4px 8px; border-radius:999px; text-transform:capitalize; }
.comp-title { font-weight:600; color:#0f172a; }
.comp-meta { color:#64748b; font-size:12px; }
.comp-actions { display:flex; align-items:center; gap:8px; }
.comp-actions button { border:none; background:none; cursor:pointer; color:#475569; padding:6px; border-radius:8px; transition:background .2s,color .2s; }
.comp-actions button:hover { background:#e2e8f0; color:#0f172a; }
.comp-actions .danger { color:#ef4444; }

.component-editor { margin-top:16px; background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:14px; box-shadow:0 10px 24px rgba(15,23,42,0.06); }
.component-editor h4 { margin-top:0; }
.component-editor .editor-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px; }
.component-editor label { display:flex; flex-direction:column; gap:4px; font-size:14px; color:#0f172a; }
.component-editor input, .component-editor textarea, .component-editor select { width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:8px; background:#fff; }
.component-editor .subhead { font-weight:700; color:#0f172a; grid-column:1/-1; margin-top:6px; display:flex; align-items:center; justify-content:space-between; gap:8px; }
.component-editor .btn-link { border:none; background:none; color:#ef4444; cursor:pointer; font-size:12px; padding:0; text-decoration:underline; }
.component-editor .btn-outline-admin {
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:8px 12px;
    border:1px solid #0ea5e9;
    border-radius:999px;
    background:#e0f2fe;
    cursor:pointer;
    color:#0f172a;
    font-weight:600;
    box-shadow:0 4px 10px rgba(14,165,233,0.18);
    transition:transform .12s ease, box-shadow .12s ease, background .12s ease;
}
.component-editor .btn-outline-admin:hover {
    transform:translateY(-1px);
    box-shadow:0 6px 14px rgba(14,165,233,0.25);
    background:#bae6fd;
}
.editor-empty { color:#94a3b8; font-size:14px; }
</style>
