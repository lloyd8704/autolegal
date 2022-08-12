import AbstractView from "./AbstractView.js";

export default class extends AbstractView {
    constructor(params) {
        super(params);
        this.setTitle("Dashboard");
    }

    async getHtml() {
        return `
            <h1>Dashboard</h1>
            <p>
                We will think of stuff to put here
            </p>
        `;
    }
}