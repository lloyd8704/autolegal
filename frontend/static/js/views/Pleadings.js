import AbstractView from "./AbstractView.js";

export default class extends AbstractView {
    constructor(params) {
        super(params);
        this.setTitle("Pleadings");
    }

    async getHtml() {
        return `
            <h1>Pleadings</h1>
            <p>Should be on the Pleadings page!</p>
        `;
    }
}