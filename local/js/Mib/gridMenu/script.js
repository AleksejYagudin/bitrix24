BX.ready(function () {
    const sendRemoteBatch = BX.namespace('sendRemoteBatch');
    sendRemoteBatch.init = function () {
        BX.addCustomEvent('Grid::ready', BX.proxy(this.insertAction, this));
        BX.addCustomEvent('Grid::updated', BX.proxy(this.insertAction, this));
    }

    sendRemoteBatch.insertAction = function (grid) {
        if (grid.getContainerId() !== 'CRM_LEAD_LIST_V12') {
            return;
        }

        const actionDropdown = grid.getActionsPanel().getDropdowns()[0];

        if (!actionDropdown) {
            return;
        }

        let items = BX.parseJSON(BX.data(actionDropdown, 'items'));

        if (!BX.type.isArray(items)) {
            return;
        }

        if (items.find(i => i.VALUE === 'send_to_remote_system')) {
            return;
        }

        items.push({
            NAME: 'Новые пункт',
            VALUE: 'Send to Remote System',
            ONCHANGE: [
                {
                    ACTION: 'CALLBACK',
                    DATA: [
                         {JS: "BX.ajax.runComponentAction('mib:renderData', 'render', {\n" +
                                 "\tmode: 'class', //это означает, что мы хотим вызывать действие из class.php\n" +
                                 "\tdata: {\n" +
                                 "\t\tperson: 'TEST' //данные будут автоматически замаплены на параметры метода \n" +
                                 "\t},\n" +
                                 "\tanalyticsLabel: {\n" +
                                 "\t\tviewMode: 'grid',\n" +
                                 "\t\tfilterState: 'closed'\t\n" +
                                 "\t}\t\n" +
                                 "}).then(function (response) {\n" +
                                 "\tconsole.log(response);\n" +
                                 "\t/**\n" +
                                 "\t{\n" +
                                 "\t\t\"status\": \"success\", \n" +
                                 "\t\t\"data\": \"Hi Hero!\", \n" +
                                 "\t\t\"errors\": []\n" +
                                 "\t}\n" +
                                 "\t**/\t\t\t\n" +
                                 "}, function (response) {\n" +
                                 "\t//сюда будут приходить все ответы, у которых status !== 'success'\n" +
                                 "\tconsole.log(response);\n" +
                                 "\t/**\n" +
                                 "\t{\n" +
                                 "\t\t\"status\": \"error\", \n" +
                                 "\t\t\"errors\": [...]\n" +
                                 "\t}\n" +
                                 "\t**/\t\t\t\t\n" +
                                 "});"}
                     ]
                }
            ]
        });
        actionDropdown.dataset.items = JSON.stringify(items);
    }
    sendRemoteBatch.init();
})




