describe('create department',()=>{
    beforeEach(()=>{
        cy.visit('login');
        cy.getElementByFullName('email').type('admin@example.com').should('be.visible');
        cy.getElementByFullName('password').type('123456789').should('be.visible');
        cy.getElementByFullName('login').click();

    });
    it.only('create department',()=>{
        cy.getElementByFullName('department').should('be.visible').click();
        cy.getElementByFullName('createDepartment').should('be.visible').click();
        cy.getElementByFullName('nameDepartment').type('GANG GANG').should('be.visible');
        cy.get('select[data-test="MANAGER"]').select('somsri',{force:true});
        cy.get('select[data-test="EMPLOYEE"]').select('somsawas',{force:true});
        cy.getElementByFullName('SUBMIT').click();
        //.select('somsri',{force:true});

    });
});