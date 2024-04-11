let section_list = 1;
	
BX.addCustomEvent(
	"BX.Crm.EntityEditor:onInit",
	BX.delegate(function (params) {
		const postData = async (url = "", data = {}) => {
			// Формируем запрос
			const response = await fetch(url, {
				// Метод, если не указывать, будет использоваться GET
				method: "POST",
				// Заголовок запроса
				headers: {
					"Content-Type": "application/json",
				},
				// Данные
				body: JSON.stringify(data),
			});
			return response.json();
		};
		postData("/local/pop_up_Deal/index2.php", {}).then((data) => {
			section_list_settings = data;
			const all_section_node = [
				...document.getElementsByClassName("ui-entity-editor-section"),
			];
			all_section_node.forEach((section_node) => {

				let section_settings = section_list_settings.find(
					(section) => section.NAME === section_node.dataset.cid
				);
				if (section_settings.HIDDEN === 'Y'){
					section_node.childNodes[1].style.display = "none";
				}
					
			})

		});
		// sectionNode.childNodes[1].style.display = "none";
		// children1 = getChildren(this);
	})
);	 
BX.addCustomEvent(
	"BX.Crm.EntityEditorSection:onLayout",
	BX.delegate(function (params) {
		
		button = document.createElement("button");        
		id = params["_id"]; // data_cid ui-entity-editor-section

		// button.id = id;
		// button.className = "button open";		       
		// button.textContent = "-";   
		button.onclick = function () {
			children1 = getChildren(this);
			if (this.className === "button close") {
				children1.style.display = "block";
				this.className = "button open";
				this.textContent = "-";
			} else {
				children1.style.display = "none";
				this.className = "button close";
				this.textContent = "+";
			}
		};
		params["_headerContainer"].append(button);
	})
);

function getChildren(button){
	
	const all_section = [
		...document.getElementsByClassName("ui-entity-editor-section"),
	];	
	const section_node = all_section.find(
		(element) => element.dataset.cid === button.id
	);
	const children1 = section_node.childNodes[1];
	return children1;
}
