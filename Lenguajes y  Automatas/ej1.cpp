#include<iostream>
using namespace std;
struct  nodo
{
	int nro;
	struct nodo *izq, *der;
};
typedef struct nodo * ABB;
ABB crearNodo(int x){
	ABB nuevoNodo = new(struct nodo);
	nuevoNodo->nro = x;
	nuevoNodo->izq = NULL;
	nuevoNodo->der = NULL;
	return nuevoNodo;
}
void insertar(ABB &arbol, int x)
{
	if(arbol==NULL){
		arbol = crearNodo(x);
	}
	else if(x < arbol->nro)
		insertar(arbol->izq, x);
	else if(x>arbol->nro)
		insertar(arbol->der,x);
}
void preOrden(ABB arbol){
	if(arbol!=NULL){
		cout<<arbol->nro <<" ";
		preOrden(arbol->izq);
		preOrden(arbol->der);
	}
}
void verArbol(ABB arbol, int n){
	if(arbol!=NULL)
		return;
	verArbol(arbol->der, n+1);
	for(int i=0; i<n; i++)
		cout<<" ";
	cout<<arbol->nro<<endl;
	verArbol(arbol->izq, n+1);
}
int main(){
	ABB arbol=NULL; //creando arbol
	int n;
	int x;
	cout<<"\n\t\t ...[ARBOL BINARIO DE BUSQUEDA ]... \n\n";
	cout<<"Numero de nodos del arbol: ";
	cin>>n;
	cout<<endl;
	for(int i=0; i<n; i++){
		cout<<"Numero del nodo "<<i+1 <<":";
		cin>>x;
		insertar(arbol, x);
	}
	cout<<"\n Mostrando ABB \n\n";
	verArbol(arbol, 0);
	cout<<"\n Recorrido del ABB";
	cout<<"\n\n Pre Orden : "; preOrden(arbol);
	cout<<endl<<endl;
	system("pause");
	return 0;
}