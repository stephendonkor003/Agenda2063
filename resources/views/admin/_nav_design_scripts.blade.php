<script>
(function(){
    const listEl = document.getElementById('componentList');
    const input = document.getElementById('componentsJson');
    const editor = document.getElementById('componentEditor');
    const templates = {
        aspirations: {type:'aspirations', title:'Aspirations', intro:'', cards:[{title:'',text:'',image_url:'',link:''}]},
        flagships: {type:'flagships', title:'Flagship Projects', items:[{title:'',text:'',image_url:'',link:''}]},
        press: {type:'press', title:'Press Releases', items:[{title:'',date:'',text:'',link:''}]},
        quiz: {type:'quiz', title:'Test Your Knowledge', description:'', cta_label:'Start Quiz', cta_url:'/quiz', questions:[{question:'', answers:[{text:'', correct:false},{text:'', correct:false}], points:1}]},
        hero_slider: {type:'hero_slider', title:'Hero Slider', slides:[{title:'Slide title', subtitle:'', link_label:'Learn more', link_url:'', image_url:'', alt:''}]},
        about_page: {
            type:'about_page',
            title:'About Page',
            hero:{label:'The Africa We Want', title:'About Agenda 2063', subtitle:'Africa\'s Blueprint for Transformation', images:[]},
            sections:[{id:'overview', title:'About the Africa We Want', intro:'', paragraphs:[''], image_url:''}],
            moonshots:[{title:'Education Revolution', text:'100% of African children will complete primary and secondary education with quality learning outcomes', progress:45, icon:'fa-graduation-cap'}],
            timeline:[{period:'2013', title:'Agenda 2063 Adopted', text:'African Union Heads of State and Government adopted Agenda 2063 as Africa\'s development blueprint', active:false}]
        },
        timeline: {
            type:'timeline',
            title:'Our Journey to 2063',
            subtitle:'Key milestones in Africa\'s transformation',
            items:[
                {period:'2013', title:'Agenda 2063 Adopted', text:'Heads of State adopted Agenda 2063 as Africa\'s development blueprint', active:false},
                {period:'2014-2023', title:'First Ten-Year Plan', text:'Implementation of the first 10-year plan focusing on flagship projects', active:false},
                {period:'2024-2033', title:'Second Ten-Year Plan', text:'Accelerating implementation with focus on industrialization and integration', active:true}
            ]
        },
        flagship_page: {
            type:'flagship_page',
            title:'Flagship Projects',
            subtitle:'Transformative initiatives accelerating Africa\'s integration',
            hero_image:'',
            items:[
                {title:'INTEGRATED HIGH SPEED TRAIN NETWORK', subtitle:'Connecting African Capitals and Commercial Centres', image_url:'', paragraphs:['Aims to connect all African capitals and commercial centres through a high-speed train network.'], tags:['connectivity','mobility'], link:'/about#flagship'},
                {title:'AFRICAN COMMODITIES STRATEGY', subtitle:'Transforming Africa\'s Commodities Sector', image_url:'', paragraphs:['Continental commodities value-add strategy.'], tags:['trade','value-addition'], link:'/about#flagship'},
                {title:'AFRICAN CONTINENTAL FREE TRADE AREA (AFCFTA)', subtitle:'Boosting Intra-African Trade', image_url:'', paragraphs:['Accelerates intra-African trade and strengthens Africa\'s position.'], tags:['afcfta','trade'], link:'/about#flagship'}
            ]
        },
        richtext: {type:'richtext', heading:'', body:''},
    };

    const getData = () => { try { return JSON.parse(input.value || '[]'); } catch(e) { return []; } };
    const setData = (arr) => { input.value = JSON.stringify(arr); };

    function render(){
        const data = getData();
        listEl.innerHTML = '';
        data.forEach((c, idx) => {
            const li = document.createElement('li');
            li.dataset.index = idx;
            li.draggable = true;
            li.innerHTML = `<div class="left"><span class="handle"><i class="fa-solid fa-grip-vertical"></i></span><div><div class="comp-pill">${c.type}</div><div class="comp-title">${c.title || c.heading || c.description || ''}</div><div class="comp-meta">${summary(c)}</div></div></div><div class="comp-actions"><button type="button" data-edit="${idx}" title="Edit"><i class="fa-solid fa-pen"></i></button><button type="button" data-remove="${idx}" class="danger" title="Delete"><i class="fa-solid fa-trash"></i></button></div>`;
            li.addEventListener('dragstart', e => { e.dataTransfer.setData('text/plain', idx); });
            li.addEventListener('dragover', e => e.preventDefault());
            li.addEventListener('drop', e => {
                e.preventDefault();
                const from = parseInt(e.dataTransfer.getData('text/plain'), 10);
                const to = idx;
                if (isNaN(from)) return;
                const arr = getData();
                const [moved] = arr.splice(from,1);
                arr.splice(to,0,moved);
                setData(arr);
                render();
            });
            li.querySelector('[data-remove]').addEventListener('click', () => {
                const arr = getData();
                arr.splice(idx,1);
                setData(arr);
                render();
                clearEditor();
            });
            li.querySelector('[data-edit]').addEventListener('click', () => openEditor(idx));
            listEl.appendChild(li);
        });
        if (!data.length) {
            listEl.innerHTML = '<li style="justify-content:center;color:#94a3b8;">No components yet. Add from the library.</li>';
            clearEditor();
        }
    }

    // Render only the list (keeps editor/file inputs intact)
    function renderListOnly(){
        const data = getData();
        listEl.innerHTML = '';
        data.forEach((c, idx) => {
            const li = document.createElement('li');
            li.dataset.index = idx;
            li.draggable = true;
            li.innerHTML = `<div class="left"><span class="handle"><i class="fa-solid fa-grip-vertical"></i></span><div><div class="comp-pill">${c.type}</div><div class="comp-title">${c.title || c.heading || c.description || ''}</div><div class="comp-meta">${summary(c)}</div></div></div><div class="comp-actions"><button type="button" data-edit="${idx}" title="Edit"><i class="fa-solid fa-pen"></i></button><button type="button" data-remove="${idx}" class="danger" title="Delete"><i class="fa-solid fa-trash"></i></button></div>`;
            li.addEventListener('dragstart', e => { e.dataTransfer.setData('text/plain', idx); });
            li.addEventListener('dragover', e => e.preventDefault());
            li.addEventListener('drop', e => {
                e.preventDefault();
                const from = parseInt(e.dataTransfer.getData('text/plain'), 10);
                const to = idx;
                if (isNaN(from)) return;
                const arr = getData();
                const [moved] = arr.splice(from,1);
                arr.splice(to,0,moved);
                setData(arr);
                renderListOnly();
            });
            li.querySelector('[data-remove]').addEventListener('click', () => {
                const arr = getData();
                arr.splice(idx,1);
                setData(arr);
                renderListOnly();
                clearEditor();
            });
            li.querySelector('[data-edit]').addEventListener('click', () => openEditor(idx));
            listEl.appendChild(li);
        });
        if (!data.length) {
            listEl.innerHTML = '<li style="justify-content:center;color:#94a3b8;">No components yet. Add from the library.</li>';
            clearEditor();
        }
    }

    function summary(c){
        if (c.type === 'hero_slider') return `${(c.slides||[]).length} slides`;
        if (c.type === 'aspirations') return `${(c.cards||[]).length} cards`;
        if (c.type === 'flagships') return `${(c.items||[]).length} projects`;
        if (c.type === 'press') return `${(c.items||[]).length} press items`;
        if (c.type === 'quiz') return `${(c.questions||[]).length} questions`;
        if (c.type === 'about_page') return `hero + ${(c.sections||[]).length} sections`;
        if (c.type === 'timeline') return `${(c.items||[]).length} milestones`;
        if (c.type === 'flagship_page') return `${(c.items||[]).length} flagship items`;
        return '';
    }

    function addComponent(type){
        const tmpl = templates[type];
        if (!tmpl) return;
        const arr = getData();
        arr.push(JSON.parse(JSON.stringify(tmpl)));
        setData(arr);
        renderListOnly();
    }

    document.querySelectorAll('.component-item').forEach(el => {
        el.addEventListener('click', () => addComponent(el.dataset.type));
    });

    function clearEditor(){
        editor.innerHTML = '<div class="editor-empty">Select a component to edit its content.</div>';
    }

    function addItem(obj, key, tmpl){ if (!Array.isArray(obj[key])) obj[key] = []; obj[key].push(JSON.parse(JSON.stringify(tmpl))); }
    function removeItem(obj, key, idx){ if (!Array.isArray(obj[key])) return; obj[key].splice(idx,1); }

    function openEditor(idx){
        const data = getData();
        const comp = data[idx];
        if (!comp) return;
        const fields = [];
        const addField = (label, name, value, type='text') => {
            const val = value ?? '';
            fields.push(`<label>${label}<input type="${type}" data-field="${name}" value="${val.toString().replace(/"/g,'&quot;')}"></label>`);
        };

        if (comp.type === 'aspirations') {
            addField('Section Title','title',comp.title);
            addField('Intro','intro',comp.intro);
            fields.push('<div class="subhead">Cards</div>');
            (comp.cards||[]).forEach((card,i)=>{
                fields.push(`<div class="subhead">Card ${i+1} <button type="button" class="btn-link" data-remove-card="${i}">Remove</button></div>`);
                addField(`Card ${i+1} Title`,`cards.${i}.title`,card.title);
                fields.push(`<label>Card ${i+1} Text<textarea data-field="cards.${i}.text" rows="3">${card.text ?? ''}</textarea></label>`);
                addField(`Card ${i+1} Link`,`cards.${i}.link`,card.link);
                fields.push(`<label>Card ${i+1} Image Upload<input type="file" name="upload_component_${idx}_cards[]"></label>`);
            });
            fields.push(`<button type="button" class="btn-outline-admin" data-add-card="${idx}"><i class="fa-solid fa-plus"></i> Add Card</button>`);
        } else if (comp.type === 'flagships') {
            addField('Section Title','title',comp.title);
            fields.push('<div class="subhead">Projects</div>');
            (comp.items||[]).forEach((item,i)=>{
                fields.push(`<div class="subhead">Project ${i+1} <button type="button" class="btn-link" data-remove-flag="${i}">Remove</button></div>`);
                addField(`Item ${i+1} Title`,`items.${i}.title`,item.title);
                fields.push(`<label>Item ${i+1} Text<textarea data-field="items.${i}.text" rows="3">${item.text ?? ''}</textarea></label>`);
                addField(`Item ${i+1} Link`,`items.${i}.link`,item.link);
                fields.push(`<label>Item ${i+1} Image Upload<input type="file" name="upload_component_${idx}_items[]"></label>`);
            });
            fields.push(`<button type="button" class="btn-outline-admin" data-add-flag="${idx}"><i class="fa-solid fa-plus"></i> Add Project</button>`);
        } else if (comp.type === 'press') {
            addField('Section Title','title',comp.title);
            fields.push('<div class="subhead">Press Items</div>');
            (comp.items||[]).forEach((item,i)=>{
                fields.push(`<div class="subhead">Press ${i+1} <button type="button" class="btn-link" data-remove-press="${i}">Remove</button></div>`);
                addField(`Press ${i+1} Title`,`items.${i}.title`,item.title);
                addField(`Press ${i+1} Date`,`items.${i}.date`,item.date);
                fields.push(`<label>Press ${i+1} Text<textarea data-field="items.${i}.text" rows="3">${item.text ?? ''}</textarea></label>`);
                addField(`Press ${i+1} Link`,`items.${i}.link`,item.link);
                fields.push(`<label>Press ${i+1} Attachment<input type="file" name="upload_component_${idx}_press[]"></label>`);
            });
            fields.push(`<button type="button" class="btn-outline-admin" data-add-press="${idx}"><i class="fa-solid fa-plus"></i> Add Press</button>`);
        } else if (comp.type === 'quiz') {
            addField('Quiz Title','title',comp.title);
            fields.push(`<label>Description<textarea data-field="description" rows="3">${comp.description ?? ''}</textarea></label>`);
            addField('CTA Label','cta_label',comp.cta_label);
            addField('CTA URL','cta_url',comp.cta_url);
            fields.push('<div class="subhead">Questions</div>');
            (comp.questions||[]).forEach((q,i)=>{
                fields.push(`<div class="subhead">Question ${i+1} <button type="button" class="btn-link" data-remove-question="${i}">Remove</button></div>`);
                fields.push(`<label>Question ${i+1}<textarea data-field="questions.${i}.question" rows="2">${q.question ?? ''}</textarea></label>`);
                addField(`Points`,`questions.${i}.points`,q.points || 1,'number');
                (q.answers||[]).forEach((a,j)=>{
                    fields.push(`<label>Answer ${j+1} <input type="text" data-field="questions.${i}.answers.${j}.text" value="${a.text ?? ''}"> <select data-field="questions.${i}.answers.${j}.correct"><option value="false" ${a.correct?'':'selected'}>Wrong</option><option value="true" ${a.correct?'selected':''}>Correct</option></select> <button type="button" class="btn-link" data-remove-answer="${i}:${j}">Remove</button></label>`);
                });
                fields.push(`<button type="button" class="btn-outline-admin" data-add-answer="${idx}:${i}"><i class="fa-solid fa-plus"></i> Add Answer</button>`);
            });
            fields.push(`<button type="button" class="btn-outline-admin" data-add-question="${idx}"><i class="fa-solid fa-plus"></i> Add Question</button>`);
        } else if (comp.type === 'hero_slider') {
            addField('Section Title','title',comp.title);
            fields.push('<div class="subhead">Slides</div>');
            (comp.slides||[]).forEach((slide,i)=>{
                fields.push(`<div class="subhead">Slide ${i+1} <button type="button" class="btn-link" data-remove-slide="${i}">Remove</button></div>`);
                addField(`Slide ${i+1} Title`,`slides.${i}.title`,slide.title);
                addField(`Slide ${i+1} Subtitle`,`slides.${i}.subtitle`,slide.subtitle);
                addField(`Slide ${i+1} CTA Label`,`slides.${i}.link_label`,slide.link_label);
                addField(`Slide ${i+1} CTA URL`,`slides.${i}.link_url`,slide.link_url);
                addField(`Slide ${i+1} Alt`,`slides.${i}.alt`,slide.alt);
                fields.push(`<label>Slide ${i+1} Image Upload<input type="file" name="upload_component_${idx}_slides[]"></label>`);
            });
            fields.push(`<button type="button" class="btn-outline-admin" data-add-slide="${idx}"><i class="fa-solid fa-plus"></i> Add Slide</button>`);
        } else if (comp.type === 'about_page') {
            fields.push('<div class="subhead">Hero</div>');
            addField('Hero Label','hero.label',comp.hero?.label ?? '');
            addField('Hero Title','hero.title',comp.hero?.title ?? '');
            addField('Hero Subtitle','hero.subtitle',comp.hero?.subtitle ?? '');
            (comp.hero?.images || []).forEach((img,i)=>{
                addField(`Hero Image ${i+1}`,`hero.images.${i}`,img);
                fields.push(`<button type="button" class="btn-link" data-remove-hero-img="${i}">Remove Image</button>`);
            });
            fields.push(`<label>Upload Hero Images<input type="file" name="upload_component_${idx}_hero[]" multiple></label>`);
            fields.push(`<button type="button" class="btn-outline-admin" data-add-hero-img="${idx}"><i class="fa-solid fa-plus"></i> Add Hero Image</button>`);

            fields.push('<div class="subhead">Sections</div>');
            (comp.sections||[]).forEach((s,i)=>{
                fields.push(`<div class="subhead">Section ${i+1} <button type="button" class="btn-link" data-remove-section="${i}">Remove</button></div>`);
                addField(`ID`,`sections.${i}.id`,s.id ?? '');
                addField(`Title`,`sections.${i}.title`,s.title ?? '');
                addField(`Intro`,`sections.${i}.intro`,s.intro ?? '');
                addField(`Image URL`,`sections.${i}.image_url`,s.image_url ?? '');
                fields.push(`<label>Section ${i+1} Image Upload<input type="file" name="upload_component_${idx}_sections[]"></label>`);
                (s.paragraphs||[]).forEach((p,j)=>{
                    fields.push(`<label>Paragraph ${j+1}<textarea data-field="sections.${i}.paragraphs.${j}" rows="3">${p ?? ''}</textarea></label>`);
                    fields.push(`<button type="button" class="btn-link" data-remove-paragraph="${i}:${j}">Remove Paragraph</button>`);
                });
                fields.push(`<button type="button" class="btn-outline-admin" data-add-paragraph="${i}"><i class="fa-solid fa-plus"></i> Add Paragraph</button>`);
            });
            fields.push(`<button type="button" class="btn-outline-admin" data-add-section="${idx}"><i class="fa-solid fa-plus"></i> Add Section</button>`);

            fields.push('<div class="subhead">Moonshots</div>');
            (comp.moonshots||[]).forEach((m,i)=>{
                fields.push(`<div class="subhead">Moonshot ${i+1} <button type="button" class="btn-link" data-remove-moonshot="${i}">Remove</button></div>`);
                addField(`Title`,`moonshots.${i}.title`,m.title ?? '');
                addField(`Icon (FontAwesome class)`,`moonshots.${i}.icon`,m.icon ?? 'fa-circle');
                addField(`Progress %`,`moonshots.${i}.progress`,m.progress ?? 0,'number');
                fields.push(`<label>Description<textarea data-field="moonshots.${i}.text" rows="2">${m.text ?? ''}</textarea></label>`);
            });
            fields.push(`<button type="button" class="btn-outline-admin" data-add-moonshot="${idx}"><i class="fa-solid fa-plus"></i> Add Moonshot</button>`);

            fields.push('<div class="subhead">Timeline</div>');
            (comp.timeline||[]).forEach((t,i)=>{
                fields.push(`<div class="subhead">Item ${i+1} <button type="button" class="btn-link" data-remove-timeline="${i}">Remove</button></div>`);
                addField(`Period`,`timeline.${i}.period`,t.period ?? '');
                addField(`Title`,`timeline.${i}.title`,t.title ?? '');
                fields.push(`<label>Text<textarea data-field="timeline.${i}.text" rows="2">${t.text ?? ''}</textarea></label>`);
                fields.push(`<label>Active<select data-field="timeline.${i}.active"><option value="false" ${t.active?'':'selected'}>No</option><option value="true" ${t.active?'selected':''}>Yes</option></select></label>`);
            });
            fields.push(`<button type="button" class="btn-outline-admin" data-add-timeline="${idx}"><i class="fa-solid fa-plus"></i> Add Timeline Item</button>`);
        } else if (comp.type === 'timeline') {
            addField('Title','title',comp.title);
            addField('Subtitle','subtitle',comp.subtitle);
            fields.push('<div class="subhead">Timeline Items</div>');
            (comp.items||[]).forEach((t,i)=>{
                fields.push(`<div class="subhead">Item ${i+1} <button type="button" class="btn-link" data-remove-timeline-item="${i}">Remove</button></div>`);
                addField(`Period`,`items.${i}.period`,t.period ?? '');
                addField(`Title`,`items.${i}.title`,t.title ?? '');
                fields.push(`<label>Text<textarea data-field="items.${i}.text" rows="2">${t.text ?? ''}</textarea></label>`);
                fields.push(`<label>Active<select data-field="items.${i}.active"><option value="false" ${t.active?'':'selected'}>No</option><option value="true" ${t.active?'selected':''}>Yes</option></select></label>`);
            });
            fields.push(`<button type="button" class="btn-outline-admin" data-add-timeline-item="${idx}"><i class="fa-solid fa-plus"></i> Add Timeline Item</button>`);
        } else if (comp.type === 'flagship_page') {
            addField('Page Title','title',comp.title);
            addField('Subtitle','subtitle',comp.subtitle);
            addField('Hero Image URL','hero_image',comp.hero_image);
            fields.push(`<label>Upload Hero Image<input type="file" name="upload_component_${idx}_hero_image"></label>`);
            fields.push('<div class="subhead">Flagship Items</div>');
            (comp.items||[]).forEach((item,i)=>{
                fields.push(`<div class="subhead">Item ${i+1} <button type="button" class="btn-link" data-remove-flagship-item="${i}">Remove</button></div>`);
                addField(`Title`,`items.${i}.title`,item.title);
                addField(`Subtitle`,`items.${i}.subtitle`,item.subtitle);
                addField(`Tags (comma separated)`,`items.${i}.tags`, Array.isArray(item.tags) ? item.tags.join(', ') : (item.tags || ''));
                (item.paragraphs||['']).forEach((p,j)=>{
                    fields.push(`<label>Paragraph ${j+1}<textarea data-field="items.${i}.paragraphs.${j}" rows="4">${p ?? ''}</textarea></label>`);
                    fields.push(`<button type="button" class="btn-link" data-remove-flagship-paragraph="${i}:${j}">Remove Paragraph</button>`);
                });
                fields.push(`<button type="button" class="btn-outline-admin" data-add-flagship-paragraph="${i}"><i class="fa-solid fa-plus"></i> Add Paragraph</button>`);
                addField(`Link`,`items.${i}.link`,item.link);
                addField(`Image URL`,`items.${i}.image_url`,item.image_url);
                fields.push(`<label>Image Upload<input type="file" name="upload_component_${idx}_items[]"></label>`);
            });
            fields.push(`<button type="button" class="btn-outline-admin" data-add-flagship-item="${idx}"><i class="fa-solid fa-plus"></i> Add Flagship Item</button>`);
        } else if (comp.type === 'richtext') {
            addField('Heading','heading',comp.heading);
            fields.push(`<label>Body<textarea data-field="body" rows="4">${comp.body ?? ''}</textarea></label>`);
        }

        editor.innerHTML = `
            <h4>Edit ${comp.type}</h4>
            <div class="editor-grid">
                ${fields.join('')}
            </div>
            <div style="margin-top:10px;">
                <button type="button" id="saveComponent" class="btn-primary-admin"><i class="fa-solid fa-save"></i> Update Component</button>
            </div>
        `;

        // dynamic add/remove handlers
        editor.querySelectorAll('[data-add-card]').forEach(btn => {
            btn.addEventListener('click', () => { addItem(comp, 'cards', {title:'',text:'',image_url:'',link:''}); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-card]').forEach(btn => {
            btn.addEventListener('click', () => { removeItem(comp, 'cards', Number(btn.getAttribute('data-remove-card'))); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-flag]').forEach(btn => {
            btn.addEventListener('click', () => { addItem(comp, 'items', {title:'',text:'',image_url:'',link:''}); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-flag]').forEach(btn => {
            btn.addEventListener('click', () => { removeItem(comp, 'items', Number(btn.getAttribute('data-remove-flag'))); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-press]').forEach(btn => {
            btn.addEventListener('click', () => { addItem(comp, 'items', {title:'',date:'',text:'',link:''}); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-press]').forEach(btn => {
            btn.addEventListener('click', () => { removeItem(comp, 'items', Number(btn.getAttribute('data-remove-press'))); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-question]').forEach(btn => {
            btn.addEventListener('click', () => { addItem(comp, 'questions', {question:'', answers:[{text:'',correct:false},{text:'',correct:false}], points:1}); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-question]').forEach(btn => {
            btn.addEventListener('click', () => { removeItem(comp, 'questions', Number(btn.getAttribute('data-remove-question'))); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-answer]').forEach(btn => {
            btn.addEventListener('click', () => { const [cIdx,qIdx] = btn.getAttribute('data-add-answer').split(':').map(Number); if (isNaN(qIdx)) return; comp.questions[qIdx].answers.push({text:'',correct:false}); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-answer]').forEach(btn => {
            btn.addEventListener('click', () => { const [qIdx,aIdx] = btn.getAttribute('data-remove-answer').split(':').map(Number); if (isNaN(qIdx) || isNaN(aIdx)) return; comp.questions[qIdx].answers.splice(aIdx,1); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-slide]').forEach(btn => {
            btn.addEventListener('click', () => { addItem(comp, 'slides', {title:'',subtitle:'',link_label:'Learn more',link_url:'',image_url:'',alt:''}); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-slide]').forEach(btn => {
            btn.addEventListener('click', () => { removeItem(comp, 'slides', Number(btn.getAttribute('data-remove-slide'))); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-hero-img]').forEach(btn => {
            btn.addEventListener('click', () => { comp.hero = comp.hero || {}; comp.hero.images = comp.hero.images || []; comp.hero.images.push(''); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-hero-img]').forEach(btn => {
            btn.addEventListener('click', () => { const i = Number(btn.getAttribute('data-remove-hero-img')); comp.hero.images.splice(i,1); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-section]').forEach(btn => {
            btn.addEventListener('click', () => { addItem(comp, 'sections', {id:'section-'+((comp.sections?.length||0)+1), title:'', intro:'', paragraphs:[''], image_url:''}); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-section]').forEach(btn => {
            btn.addEventListener('click', () => { removeItem(comp, 'sections', Number(btn.getAttribute('data-remove-section'))); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-paragraph]').forEach(btn => {
            btn.addEventListener('click', () => { const sIdx = Number(btn.getAttribute('data-add-paragraph')); if (isNaN(sIdx)) return; comp.sections[sIdx].paragraphs = comp.sections[sIdx].paragraphs || []; comp.sections[sIdx].paragraphs.push(''); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-paragraph]').forEach(btn => {
            btn.addEventListener('click', () => { const [s,p] = btn.getAttribute('data-remove-paragraph').split(':').map(Number); if (isNaN(s) || isNaN(p)) return; comp.sections[s].paragraphs.splice(p,1); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-moonshot]').forEach(btn => {
            btn.addEventListener('click', () => { addItem(comp, 'moonshots', {title:'', text:'', progress:0, icon:'fa-circle'}); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-moonshot]').forEach(btn => {
            btn.addEventListener('click', () => { removeItem(comp, 'moonshots', Number(btn.getAttribute('data-remove-moonshot'))); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-timeline]').forEach(btn => {
            btn.addEventListener('click', () => { addItem(comp, 'timeline', {period:'', title:'', text:'', active:false}); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-timeline]').forEach(btn => {
            btn.addEventListener('click', () => { removeItem(comp, 'timeline', Number(btn.getAttribute('data-remove-timeline'))); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-timeline-item]').forEach(btn => {
            btn.addEventListener('click', () => { addItem(comp, 'items', {period:'', title:'', text:'', active:false}); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-remove-timeline-item]').forEach(btn => {
            btn.addEventListener('click', () => { removeItem(comp, 'items', Number(btn.getAttribute('data-remove-timeline-item'))); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-flagship-item]').forEach(btn => {
            btn.addEventListener('click', () => {
                addItem(comp, 'items', {title:'', subtitle:'', paragraphs:[''], tags:[], link:'', image_url:''});
                const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx);
            });
        });
        editor.querySelectorAll('[data-remove-flagship-item]').forEach(btn => {
            btn.addEventListener('click', () => { removeItem(comp, 'items', Number(btn.getAttribute('data-remove-flagship-item'))); const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx); });
        });
        editor.querySelectorAll('[data-add-flagship-paragraph]').forEach(btn => {
            btn.addEventListener('click', () => {
                const i = Number(btn.getAttribute('data-add-flagship-paragraph'));
                if (isNaN(i)) return;
                comp.items[i].paragraphs = comp.items[i].paragraphs || [];
                comp.items[i].paragraphs.push('');
                const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx);
            });
        });
        editor.querySelectorAll('[data-remove-flagship-paragraph]').forEach(btn => {
            btn.addEventListener('click', () => {
                const [itemIdx, pIdx] = btn.getAttribute('data-remove-flagship-paragraph').split(':').map(Number);
                if (isNaN(itemIdx) || isNaN(pIdx)) return;
                comp.items[itemIdx].paragraphs.splice(pIdx,1);
                const arr = getData(); arr[idx]=comp; setData(arr); openEditor(idx);
            });
        });

        editor.querySelector('#saveComponent').addEventListener('click', () => {
            const controls = editor.querySelectorAll('[data-field]');
            controls.forEach(ctrl => {
                const path = ctrl.getAttribute('data-field').split('.');
                let ref = comp;
                for (let i=0;i<path.length-1;i++) {
                    const key = path[i];
                    if (ref[key] === undefined) ref[key] = isNaN(Number(path[i+1])) ? {} : [];
                    ref = ref[key];
                }
                const last = path[path.length-1];
                if (ctrl.tagName === 'SELECT') {
                    ref[last] = ctrl.value === 'true';
                } else if (ctrl.type === 'number') {
                    ref[last] = Number(ctrl.value || 0);
                } else {
                    ref[last] = ctrl.value;
                }
            });
            const arr = getData();
            arr[idx] = comp;
            setData(arr);
            renderListOnly(); // keep editor (and file inputs) intact
        });
    }

    renderListOnly();
})();
</script>
