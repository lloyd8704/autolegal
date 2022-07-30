import AbstractView from "./AbstractView.js";

export default class extends AbstractView {
    constructor(params) {
        super(params);
        this.setTitle("Correspondence");
    }

    async getHtml() {
        return `
            <h1>Correspondence</h1>
            <p>Should be on the Correspondence page!</p>
        `;
    }
}