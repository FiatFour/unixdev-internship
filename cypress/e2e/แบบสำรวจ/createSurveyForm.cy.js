describe('can edit role',()=>{
    beforeEach(()=>{
        cy.visit('login');
        cy.getElementByFullName('email').type('manager@example.com').should('be.visible');
        cy.getElementByFullName('password').type('123456789').should('be.visible');
        cy.getElementByFullName('login').click();
        //  cy.location('pathname').shadow('equal', '/manager/survey-forms');
    });

    it('Create survey forms',()=>{
        cy.getElementByFullName('createSurveyForm').focus().click();
        //onechoice
        cy.getElementByFullName('oneChoice').should('be.visible').click();
        cy.getElementByFullName('nameOneChoice').type('วันนี้วันอะไร').should('be.visible');
        cy.getElementByFullName('randomOneChoice').should('be.visible').click();
        cy.getElementByFullName('sortOneChoice').should('be.visible').click();
        //onechoice1
        cy.getElementByFullName('createOneChoice').should('be.visible').click();
        cy.getElementByFullName('textOneChoice').last().should('be.visible').type('25/3/67');
        cy.getElementByFullName('scoreOneChoice').last().should('be.visible').type('3');
        //onechoice2
        cy.getElementByFullName('createOneChoice').should('be.visible').click();
        cy.getElementByFullName('textOneChoice').last().should('be.visible').type('26/3/67');
        cy.getElementByFullName('scoreOneChoice').last().should('be.visible').type('1');
        //onechoice3
        cy.getElementByFullName('createOneChoice').should('be.visible').click();
        cy.getElementByFullName('textOneChoice').last().should('be.visible').type('27/3/67');
        cy.getElementByFullName('scoreOneChoice').last().should('be.visible').type('1');
        //onechoice4
        cy.getElementByFullName('createOneChoice').should('be.visible').click();
        cy.getElementByFullName('deleteOneChoice').last().should('be.visible').click();
        cy.getElementByFullName('saveOneChoice').should('be.visible').click();

        //--------------------------------------------------------
        //ManyChoice
        cy.getElementByFullName('manyChoice').should('be.visible').click();
        cy.getElementByFullName('nameManyChoice').type('อะไรเป็นสีโทนร้อน').should('be.visible');
        cy.getElementByFullName('randomManyChoice').should('be.visible').click();
        cy.getElementByFullName('sortManyChoice').should('be.visible').click();
        //ManyChoice1
        cy.getElementByFullName('createManyChoice').should('be.visible').click();
        cy.getElementByFullName('textManyChoice').last().should('be.visible').type('แดง');
        cy.getElementByFullName('scoreManyChoice').last().should('be.visible').type('3');
        //ManyChoice2
        cy.getElementByFullName('createManyChoice').should('be.visible').click();
        cy.getElementByFullName('textManyChoice').last().should('be.visible').type('เหลือง');
        cy.getElementByFullName('scoreManyChoice').last().should('be.visible').type('3');
        //ManyChoice3
        cy.getElementByFullName('createManyChoice').should('be.visible').click();
        cy.getElementByFullName('textManyChoice').last().should('be.visible').type('เขียว');
        cy.getElementByFullName('scoreManyChoice').last().should('be.visible').type('1');
        //ManyChoice4
        cy.getElementByFullName('createManyChoice').should('be.visible').click();
        cy.getElementByFullName('deleteManyChoice').last().should('be.visible').click();
        cy.getElementByFullName('saveManyChoice').should('be.visible').click();
    
        //-----------------------------------------------------------------------------------------
        //TextChoice
        cy.getElementByFullName('textChoice').should('be.visible').click();
        cy.getElementByFullName('nameTextChoice').type('วันนี้กินอะไรดี').should('be.visible');
        cy.getElementByFullName('saveTextChoice').should('be.visible').click();
        
        cy.getElementByFullName('submit').should('be.visible').click();

    });

});