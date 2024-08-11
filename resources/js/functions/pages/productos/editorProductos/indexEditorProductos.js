let Controller = null;

class IndexProductosEditorHandler extends FrontTools{
    constructor(){
        super();
        this.KEY_FILTER = 'fil-editorProd-adm';
        this.KEY_LASTPAG = 'lastpag-editorProd-adm';
    }
}

document.addEventListener('DOMContentLoaded', e => {
    Controller = new IndexProductosEditorHandler();
    
})
