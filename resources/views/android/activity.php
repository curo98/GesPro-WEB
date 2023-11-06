package iberoplast.pe.gespro.ui.modules.supplier

import android.content.Intent
import android.os.Bundle
import android.view.ContextMenu
import android.view.MenuInflater
import android.view.MenuItem
import android.view.View
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import iberoplast.pe.gespro.R
import iberoplast.pe.gespro.io.ApiService
import iberoplast.pe.gespro.model.Supplier
import iberoplast.pe.gespro.ui.adapters.SupplierAdapter
import iberoplast.pe.gespro.ui.modules.SuccesfulRegisterActivity
import iberoplast.pe.gespro.util.PreferenceHelper
import iberoplast.pe.gespro.util.PreferenceHelper.get
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class SuppliersActivity : AppCompatActivity() {

    private val apiService: ApiService by lazy {
        ApiService.create()
    }
    private val preferences by lazy {
        PreferenceHelper.defaultPrefs(this)
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_suppliers)

        val rvSuppliers = findViewById<RecyclerView>(R.id.rvProveedores)
        rvSuppliers.layoutManager = LinearLayoutManager(this)
        registerForContextMenu(rvSuppliers)
        rvSuppliers.isLongClickable = true

        loadSuppliers()
    }

    override fun onCreateContextMenu(menu: ContextMenu?, v: View?, menuInfo: ContextMenu.ContextMenuInfo?) {
        super.onCreateContextMenu(menu, v, menuInfo)

        if (v?.id == R.id.rvProveedores) {
            val inflater: MenuInflater = menuInflater
            inflater.inflate(R.menu.menu_options, menu)
        }
    }

    override fun onContextItemSelected(item: MenuItem): Boolean {
        when (item.itemId) {
            R.id.opc2 -> {
                // Handle Option 1: Send the ID to another activity
                val intent = Intent(this, SuccesfulRegisterActivity::class.java)
                intent.putExtra("supplier_id", 1)
                startActivity(intent)
                return true
            }
            R.id.opc1 -> {
                // Handle Option 2: Send the ID to another activity
                val intent = Intent(this, SuccesfulRegisterActivity::class.java)
                intent.putExtra("supplier_id", 2)
                startActivity(intent)
                return true
            }
            else -> return super.onContextItemSelected(item)
        }
    }

    private fun loadSuppliers() {
        val jwt = preferences["jwt", ""]
        val call = apiService.getSuppliers("Bearer $jwt")

        call.enqueue(object : Callback<ArrayList<Supplier>> {
            override fun onResponse(call: Call<ArrayList<Supplier>>, response: Response<ArrayList<Supplier>>) {
                if (response.isSuccessful) {
                    val suppliers = response.body()

                    if (suppliers != null) {
                        // Los datos se obtuvieron correctamente, actualiza el adaptador de tu RecyclerView
                        val rvProveedores = findViewById<RecyclerView>(R.id.rvProveedores)
                        rvProveedores.layoutManager = LinearLayoutManager(this@SuppliersActivity)
                        rvProveedores.adapter = SupplierAdapter(suppliers)
                    } else {
                        // Maneja el caso donde la respuesta no contiene datos válidos
                        showToast("La respuesta no contiene datos válidos")
                    }
                } else {
                    // Maneja la respuesta de error aquí
                    showToast("Error en la respuesta de la API: ${response.code()}")
                }
            }

            override fun onFailure(call: Call<ArrayList<Supplier>>, t: Throwable) {
                TODO("Not yet implemented")
            }
        })
    }


    private fun showToast(message: String) {
        Toast.makeText(this@SuppliersActivity, message, Toast.LENGTH_SHORT).show()
    }
}
