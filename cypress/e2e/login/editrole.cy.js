describe('can edit role',()=>{
    beforeEach(()=>{
        cy.visit('login');
        cy.getElementByFullName('email').type('admin@example.com').should('be.visible');
        cy.getElementByFullName('password').type('123456789').should('be.visible');
        cy.getElementByFullName('login').click();
        cy.location('pathname').shadow('equal', '/admin/users');
    });

    it('admins can set role manager',()=>{
        cy.get('[data-test="roleRequire"] [data-test="dropdownAction"]').first().click();
        cy.get('[data-test="roleRequire"] [data-test="edit"]').first().click();
        cy.get('select[data-test="role"] ').select('MANAGER', {force: true});
        cy.getElementByFullName('SUBMIT').click();        
    });
    it('admins can set role employee',()=>{
        cy.get('[data-test="roleRequire"] [data-test="dropdownAction"]').first().click();
        cy.get('[data-test="roleRequire"] [data-test="edit"]').first().click();
        cy.get('select[data-test="role"] ').select('EMPLOYEE', {force: true});
        cy.getElementByFullName('SUBMIT').click();     
    });
});