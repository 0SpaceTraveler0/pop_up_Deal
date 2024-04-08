BX.addCustomEvent(
	"BX.Crm.EntityEditorSection:onLayout",
	BX.delegate(function (params) {
        
		button = document.createElement("button");        
		id = params["_id"]; // data_cid ui-entity-editor-section
        
        button.id = id;
        button.className = "button open";		       
        button.textContent = "-";;		       

        button.onclick = function () {

            if (this.className === "button close") {
				const all_section = [ ...document.getElementsByClassName( "ui-entity-editor-section")];
				const section = all_section.find((element) => element.dataset.cid === this.id );
				const children1 = section.childNodes[1];
				children1.style.display = "block";
                this.className = "button open";
                this.textContent = "-";
			} else {
				const all_section = [ ...document.getElementsByClassName( "ui-entity-editor-section")];
				const section = all_section.find( (element) => element.dataset.cid === this.id );
				const children1 = section.childNodes[1];
				children1.style.display = "none";
                this.className = "button close";
                this.textContent = "+";
			}            
		};
		
		 BX . SidePanel . Instance . open(
				"http://localhost/local/pop_up_Deal/index.php"
			);

		params["_headerContainer"].append(button);
	})
);
