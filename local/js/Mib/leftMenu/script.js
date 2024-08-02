(function () {
    const namespace = BX.namespace('new_menu_left');
    namespace.showFacts = async function () {
        try {
            const response = await BX.ajax.runComponentAction('mib:company.facts','getFact', {mode: 'class'});
            const popup = BX.PopupWindowManager.create('company-fact', null, {
                content: response.data.fact,
                autoHide: false,
                width: 450,
                height: 700,
                closeIcon: {
                    opacity: 1,
                },
                titleBar: 'Факты о компании'
            });
            popup.show();
        } catch (e) {
            console.error(e);
        }
    }
})();